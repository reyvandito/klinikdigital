<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Konsultasi;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DokterDashboardController extends Controller
{
    private function getDokterLogin(): Dokter
    {
        return Dokter::where('user_id', Auth::id())->firstOrFail();
    }

    // ==================== DASHBOARD ====================
    public function index()
    {
        $dokter = $this->getDokterLogin();

        $konsultasiHariIni = Konsultasi::with(['pasien.user', 'jadwal'])
            ->where('dokter_id', $dokter->id)
            ->whereHas('jadwal', fn($q) => $q->whereDate('tanggal', today()))
            ->whereIn('status', ['dikonfirmasi', 'berlangsung', 'menunggu'])
            ->orderBy('created_at')
            ->get();

        $stats = [
            'hari_ini'     => $konsultasiHariIni->count(),
            'bulan_ini'    => Konsultasi::where('dokter_id', $dokter->id)
                                ->whereMonth('created_at', now()->month)->count(),
            'total_pasien' => Konsultasi::where('dokter_id', $dokter->id)
                                ->distinct('pasien_id')->count('pasien_id'),
            'selesai'      => Konsultasi::where('dokter_id', $dokter->id)
                                ->where('status', 'selesai')->count(),
        ];

        $jadwalMingguIni = Jadwal::where('dokter_id', $dokter->id)
            ->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('tanggal')
            ->get();

        return view('pages.dokter.Dashboard', compact(
            'dokter', 'konsultasiHariIni', 'stats', 'jadwalMingguIni'
        ));
    }

    // ==================== PROFILE ====================
    public function profile()
    {
        $dokter = $this->getDokterLogin();
        $user   = Auth::user();
        return view('pages.dokter.profile', compact('dokter', 'user'));
    }

    public function updateProfile(Request $request)
    {
        $user   = Auth::user();
        $dokter = $this->getDokterLogin();

        $request->validate([
            'nama'      => 'required|string|min:3|max:100',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'nomor_hp'  => 'nullable|string|min:10|max:15',
            'spesialis' => 'required|string|max:100',
        ]);

        $user->update([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'nomor_hp' => $request->nomor_hp,
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        if ($request->hasFile('foto')) {
            $request->validate(['foto' => 'image|mimes:jpeg,png,jpg|max:2048']);
            if ($dokter->foto) {
                Storage::disk('public')->delete($dokter->foto);
            }
            $path = $request->file('foto')->store('foto-dokter', 'public');
            $dokter->update(['spesialis' => $request->spesialis, 'foto' => $path]);
        } else {
            $dokter->update(['spesialis' => $request->spesialis]);
        }

        return redirect()->route('dokter.profile')
            ->with('success', 'Profile berhasil diperbarui.');
    }

    // ==================== STATUS DOKTER ====================
    public function updateStatus(Request $request)
    {
        $dokter = $this->getDokterLogin();
        $request->validate(['status' => 'required|in:aktif,tidak_aktif']);
        $dokter->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    // ==================== MANAGE JADWAL ====================
    public function jadwalIndex()
    {
        $dokter = $this->getDokterLogin();
        
        $jadwals = Jadwal::where('dokter_id', $dokter->id)
            ->whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->paginate(10);
        
        return view('pages.dokter.jadwal', compact('jadwals'));
    }

    public function jadwalStore(Request $request)
    {
        $dokter = $this->getDokterLogin();
        
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota' => 'required|integer|min:1|max:50',
        ]);
        
        $exists = Jadwal::where('dokter_id', $dokter->id)
            ->whereDate('tanggal', $request->tanggal)
            ->where('jam_mulai', $request->jam_mulai)
            ->exists();
        
        if ($exists) {
            return back()->with('error', 'Jadwal sudah ada pada tanggal dan jam tersebut.');
        }
        
        Jadwal::create([
            'dokter_id' => $dokter->id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kuota' => $request->kuota,
            'sisa_kuota' => $request->kuota,
            'status' => 'tersedia',
        ]);
        
        return redirect()->route('dokter.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function jadwalDestroy($id)
    {
        $dokter = $this->getDokterLogin();
        
        $jadwal = Jadwal::where('id', $id)
            ->where('dokter_id', $dokter->id)
            ->firstOrFail();
        
        $jadwal->delete();
        
        return redirect()->route('dokter.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    // ==================== KONSULTASI ====================
    public function mulaiKonsultasi($id)
    {
        $dokter = $this->getDokterLogin();
        $konsultasi = Konsultasi::where('id', $id)
            ->where('dokter_id', $dokter->id)
            ->firstOrFail();
        $konsultasi->update(['status' => 'berlangsung']);
        return redirect()->back()->with('success', 'Konsultasi dimulai.');
    }

    public function selesaiKonsultasi($id)
    {
        $dokter = $this->getDokterLogin();
        $konsultasi = Konsultasi::where('id', $id)
            ->where('dokter_id', $dokter->id)
            ->firstOrFail();
        $konsultasi->update(['status' => 'selesai']);
        
        // Redirect ke halaman sukses
        return view('pages.dokter.konsultasi-selesai', compact('konsultasi'))
            ->with('success', 'Konsultasi berhasil diselesaikan!');
    }

    public function riwayatKonsultasi()
    {
        $dokter = $this->getDokterLogin();
        $konsultasis = Konsultasi::with(['pasien.user', 'jadwal', 'rekamMedis'])
            ->where('dokter_id', $dokter->id)
            ->where('status', 'selesai')
            ->latest()
            ->paginate(15);
        return view('pages.dokter.riwayat-konsultasi', compact('konsultasis'));
    }

    public function detailKonsultasi($id)
    {
        $dokter = $this->getDokterLogin();
        $konsultasi = Konsultasi::with(['pasien.user', 'jadwal', 'rekamMedis'])
            ->where('id', $id)
            ->where('dokter_id', $dokter->id)
            ->firstOrFail();
        return view('pages.dokter.detail-konsultasi', compact('konsultasi'));
    }

    // ==================== DAFTAR PASIEN ====================
    public function daftarPasien(Request $request)
    {
        $dokter = $this->getDokterLogin();

        $query = Konsultasi::with(['pasien.user', 'jadwal'])
            ->where('dokter_id', $dokter->id)
            ->whereIn('status', ['menunggu', 'dikonfirmasi', 'berlangsung']);

        if ($request->search) {
            $query->whereHas('pasien.user', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $konsultasis = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.dokter.pasien', compact('konsultasis'));
    }

    public function detailPasien($id)
    {
        $pasien = Pasien::with([
            'user',
            'konsultasi' => function($q) {
                $q->with(['jadwal', 'rekamMedis', 'dokter.user'])->latest();
            }
        ])->findOrFail($id);

        return view('pages.dokter.pasien-detail', compact('pasien'));
    }

    public function simpanCatatan(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Catatan berhasil disimpan.');
    }

    // ==================== REKAM MEDIS ====================
    public function rekamMedisIndex(Request $request)
    {
        $dokter = $this->getDokterLogin();

        $query = RekamMedis::with(['konsultasi.pasien.user', 'konsultasi.jadwal'])
            ->whereHas('konsultasi', fn($q) => $q->where('dokter_id', $dokter->id));

        if ($request->search) {
            $query->whereHas('konsultasi.pasien.user', fn($q) =>
                $q->where('nama', 'like', '%' . $request->search . '%')
            );
        }

        $rekamMedis = $query->latest()->paginate(15);
        return view('pages.dokter.rekam-medis.index', compact('rekamMedis'));
    }

    public function rekamMedisCreate(Request $request)
    {
        $dokter = $this->getDokterLogin();

        $konsultasis = Konsultasi::with('pasien.user')
            ->where('dokter_id', $dokter->id)
            ->whereIn('status', ['berlangsung', 'selesai'])
            ->whereDoesntHave('rekamMedis')
            ->latest()
            ->get();

        $konsultasiTerpilih = null;
        if ($request->konsultasi_id) {
            $konsultasiTerpilih = Konsultasi::with('pasien.user')
                ->where('id', $request->konsultasi_id)
                ->where('dokter_id', $dokter->id)
                ->first();
        }

        return view('pages.dokter.rekam-medis.create', compact('konsultasis', 'konsultasiTerpilih'));
    }

    public function rekamMedisStore(Request $request)
    {
        $request->validate([
            'konsultasi_id' => 'required|exists:konsultasi,id',
            'diagnosa'      => 'required|string|min:5',
            'tindakan'      => 'nullable|string',
            'resep'         => 'nullable|string',
            'catatan'       => 'nullable|string',
        ]);

        $dokter = $this->getDokterLogin();
        $konsultasi = Konsultasi::where('id', $request->konsultasi_id)
            ->where('dokter_id', $dokter->id)
            ->firstOrFail();

        if ($konsultasi->rekamMedis) {
            return redirect()->back()
                ->with('error', 'Rekam medis untuk konsultasi ini sudah ada.');
        }

        RekamMedis::create([
            'konsultasi_id' => $request->konsultasi_id,
            'diagnosa'      => $request->diagnosa,
            'tindakan'      => $request->tindakan,
            'resep'         => $request->resep,
            'catatan'       => $request->catatan,
        ]);

        $konsultasi->update(['status' => 'selesai']);

        return redirect()->route('dokter.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil disimpan.');
    }

    public function rekamMedisEdit(Request $request)
    {
        $id     = $request->query('id');
        $dokter = $this->getDokterLogin();

        $rekamMedis = RekamMedis::with('konsultasi.pasien.user')
            ->whereHas('konsultasi', fn($q) => $q->where('dokter_id', $dokter->id))
            ->findOrFail($id);

        return view('pages.dokter.rekam-medis.edit', compact('rekamMedis'));
    }

    public function rekamMedisUpdate(Request $request, $id)
    {
        $request->validate([
            'diagnosa' => 'required|string|min:5',
            'tindakan' => 'nullable|string',
            'resep'    => 'nullable|string',
            'catatan'  => 'nullable|string',
        ]);

        $dokter = $this->getDokterLogin();
        $rekamMedis = RekamMedis::whereHas('konsultasi', fn($q) =>
            $q->where('dokter_id', $dokter->id)
        )->findOrFail($id);

        $rekamMedis->update($request->only(['diagnosa', 'tindakan', 'resep', 'catatan']));

        return redirect()->route('dokter.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function rekamMedisDelete($id)
    {
        $dokter = $this->getDokterLogin();
        $rekamMedis = RekamMedis::whereHas('konsultasi', fn($q) =>
            $q->where('dokter_id', $dokter->id)
        )->findOrFail($id);

        $rekamMedis->delete();
        return redirect()->route('dokter.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil dihapus.');
    }

    public function rekamMedisShow($id)
    {
        $dokter = $this->getDokterLogin();
        $rekamMedis = RekamMedis::with(['konsultasi.pasien.user', 'konsultasi.jadwal'])
            ->whereHas('konsultasi', fn($q) => $q->where('dokter_id', $dokter->id))
            ->findOrFail($id);

        return view('pages.dokter.rekam-medis.show', compact('rekamMedis'));
    }
}