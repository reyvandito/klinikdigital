<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Konsultasi;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // ==================== DASHBOARD ====================
    public function index()
    {
        $stats = [
            'total_dokter'     => Dokter::count(),
            'total_pasien'     => Pasien::count(),
            'total_jadwal'     => Jadwal::whereDate('tanggal', today())->count(),
            'total_konsultasi' => Konsultasi::whereDate('created_at', today())->count(),
        ];

        $dokterPending = Dokter::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $konsultasiTerbaru = Konsultasi::with(['pasien.user', 'dokter.user', 'jadwal'])
            ->latest()
            ->take(10)
            ->get();

        return view('pages.admin.dashboard', compact('stats', 'dokterPending', 'konsultasiTerbaru'));
    }

    // ==================== MANAJEMEN DOKTER ====================
    public function dokterIndex(Request $request)
    {
        $query = Dokter::with('user');

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $dokters = $query->latest()->paginate(10);
        return view('pages.admin.dokter', compact('dokters'));
    }

    public function dokterCreate()
    {
        return view('pages.admin.dokter-form');
    }

    public function dokterStore(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|min:3|max:100',
            'email'         => 'required|email|unique:users,email',
            'nomor_hp'      => 'required|string|min:10|max:15',
            'password'      => 'required|min:6',
            'spesialis'     => 'required|string|max:100',
            'no_str'        => 'required|string|unique:dokter,no_str',
            'jenis_kelamin' => 'nullable|in:L,P',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::create([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'nomor_hp'      => $request->nomor_hp,
            'password'      => Hash::make($request->password),
            'role'          => 'dokter',
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        // Upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('dokter', 'public');
        }

        Dokter::create([
            'user_id'   => $user->id,
            'spesialis' => $request->spesialis,
            'no_str'    => $request->no_str,
            'status'    => 'aktif',
            'foto'      => $fotoPath,
        ]);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function dokterEdit($id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);
        return view('pages.admin.dokter-form', compact('dokter'));
    }

    public function dokterUpdate(Request $request, $id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);

        $request->validate([
            'nama'          => 'required|string|min:3|max:100',
            'email'         => 'required|email|unique:users,email,' . $dokter->user_id,
            'nomor_hp'      => 'required|string|min:10|max:15',
            'spesialis'     => 'required|string|max:100',
            'no_str'        => 'required|string|unique:dokter,no_str,' . $id,
            'jenis_kelamin' => 'nullable|in:L,P',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dokter->user->update([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'nomor_hp'      => $request->nomor_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        if ($request->filled('password')) {
            $dokter->user->update(['password' => Hash::make($request->password)]);
        }

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($dokter->foto && Storage::disk('public')->exists($dokter->foto)) {
                Storage::disk('public')->delete($dokter->foto);
            }
            $fotoPath = $request->file('foto')->store('dokter', 'public');
            $dokter->foto = $fotoPath;
        }

        $dokter->update([
            'spesialis' => $request->spesialis,
            'no_str'    => $request->no_str,
        ]);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function dokterDelete($id)
    {
        $dokter = Dokter::findOrFail($id);
        
        // Hapus foto jika ada
        if ($dokter->foto && Storage::disk('public')->exists($dokter->foto)) {
            Storage::disk('public')->delete($dokter->foto);
        }
        
        $dokter->user->delete(); // cascade ke dokter & relasinya
        return redirect()->route('admin.dokter.index')
            ->with('success', 'Dokter berhasil dihapus.');
    }

    public function dokterVerify($id)
    {
        Dokter::findOrFail($id)->update(['status' => 'aktif']);
        return redirect()->route('admin.dokter.index')
            ->with('success', 'Dokter berhasil diverifikasi.');
    }

    public function dokterReject($id)
    {
        Dokter::findOrFail($id)->update(['status' => 'tidak_aktif']);
        return redirect()->route('admin.dokter.index')
            ->with('warning', 'Dokter ditolak / dinonaktifkan.');
    }

    // ==================== MANAJEMEN PASIEN ====================
    public function pasienIndex(Request $request)
    {
        $query = Pasien::with('user');

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $pasiens = $query->latest()->paginate(10);
        return view('pages.admin.pasien', compact('pasiens'));
    }

    public function pasienCreate()
    {
        return view('pages.admin.pasien-form');
    }

    public function pasienStore(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|min:3|max:100',
            'email'         => 'required|email|unique:users,email',
            'nomor_hp'      => 'required|string|min:10|max:15',
            'password'      => 'required|min:6',
            'tanggal_lahir' => 'nullable|date|before:today',
            'alamat'        => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
        ]);

        $user = User::create([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'nomor_hp'      => $request->nomor_hp,
            'password'      => Hash::make($request->password),
            'role'          => 'pasien',
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        Pasien::create([
            'user_id'       => $user->id,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function pasienEdit($id)
    {
        $pasien = Pasien::with('user')->findOrFail($id);
        return view('pages.admin.pasien-form', compact('pasien'));
    }

    public function pasienUpdate(Request $request, $id)
    {
        $pasien = Pasien::with('user')->findOrFail($id);

        $request->validate([
            'nama'          => 'required|string|min:3|max:100',
            'email'         => 'required|email|unique:users,email,' . $pasien->user_id,
            'nomor_hp'      => 'required|string|min:10|max:15',
            'tanggal_lahir' => 'nullable|date|before:today',
            'alamat'        => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
        ]);

        $pasien->user->update([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'nomor_hp'      => $request->nomor_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        if ($request->filled('password')) {
            $pasien->user->update(['password' => Hash::make($request->password)]);
        }

        $pasien->update([
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function pasienDelete($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->user->delete();
        return redirect()->route('admin.pasien.index')
            ->with('success', 'Pasien berhasil dihapus.');
    }

    // ==================== MANAJEMEN JADWAL ====================
    public function jadwalIndex(Request $request)
    {
        $query = Jadwal::with('dokter.user');

        if ($request->search) {
            $query->whereHas('dokter.user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $jadwals = $query->orderBy('tanggal', 'desc')->paginate(15);
        return view('pages.admin.jadwal', compact('jadwals'));
    }

    public function jadwalUpdateStatus($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $newStatus = $jadwal->status === 'tersedia' ? 'tutup' : 'tersedia';
        $jadwal->update(['status' => $newStatus]);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Status jadwal berhasil diperbarui.');
    }

    // ==================== MANAJEMEN RESERVASI ====================
    public function reservasiIndex(Request $request)
    {
        $query = Konsultasi::with(['pasien.user', 'dokter.user', 'jadwal']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->whereHas('pasien.user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $konsultasis = $query->latest()->paginate(15);
        return view('pages.admin.reservasi', compact('konsultasis'));
    }

    public function reservasiDetail($id)
    {
        $konsultasi = Konsultasi::with([
            'pasien.user', 'dokter.user', 'jadwal', 'rekamMedis'
        ])->findOrFail($id);

        return view('pages.admin.reservasi-detail', compact('konsultasi'));
    }

    public function reservasiUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,dikonfirmasi,berlangsung,selesai,dibatalkan',
        ]);

        Konsultasi::findOrFail($id)->update(['status' => $request->status]);

        return redirect()->route('admin.reservasi.index')
            ->with('success', 'Status reservasi berhasil diperbarui.');
    }

    public function reservasiDelete($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        // Kembalikan sisa kuota jadwal jika masih aktif
        $jadwal = $konsultasi->jadwal;
        if ($jadwal && in_array($konsultasi->status, ['menunggu', 'dikonfirmasi'])) {
            $jadwal->increment('sisa_kuota');
            if ($jadwal->sisa_kuota > 0 && $jadwal->status === 'penuh') {
                $jadwal->update(['status' => 'tersedia']);
            }
        }

        $konsultasi->delete();
        return redirect()->route('admin.reservasi.index')
            ->with('success', 'Reservasi berhasil dihapus.');
    }

    // ==================== PROFILE ADMIN ====================
    public function profileIndex()
    {
        $user = auth()->user();
        return view('pages.admin.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama'     => 'required|string|min:3|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'nomor_hp' => 'nullable|string|min:10|max:15',
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

        return redirect()->route('admin.profile')
            ->with('success', 'Profile berhasil diperbarui.');
    }

    // ==================== SETTINGS ====================
    public function settingsIndex()
    {
        return view('pages.admin.settings');
    }

    public function settingsUpdate(Request $request)
    {
        return redirect()->route('admin.settings')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
}