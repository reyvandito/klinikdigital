<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Konsultasi;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardPasienController extends Controller
{
    private function getPasienLogin(): Pasien
    {
        return Pasien::where('user_id', Auth::id())->firstOrFail();
    }

    // ==================== DASHBOARD ====================
    public function index()
    {
        $pasien = $this->getPasienLogin();
        $user   = Auth::user();

        $stats = [
            'total_konsultasi' => Konsultasi::where('pasien_id', $pasien->id)->count(),
            'konsultasi_aktif' => Konsultasi::where('pasien_id', $pasien->id)
                                      ->whereIn('status', ['menunggu', 'dikonfirmasi', 'berlangsung'])
                                      ->count(),
            'total_rekam_medis' => RekamMedis::whereHas('konsultasi', function ($q) use ($pasien) {
                                      $q->where('pasien_id', $pasien->id);
                                  })->count(),
        ];

        $janjiTemu = Konsultasi::with(['dokter.user', 'jadwal'])
            ->where('pasien_id', $pasien->id)
            ->whereIn('status', ['menunggu', 'dikonfirmasi'])
            ->whereHas('jadwal', function ($q) {
                $q->whereDate('tanggal', '>=', today());
            })
            ->take(3)
            ->get();

        $riwayatTerbaru = Konsultasi::with(['dokter.user', 'jadwal'])
            ->where('pasien_id', $pasien->id)
            ->where('status', 'selesai')
            ->latest()
            ->take(5)
            ->get();

        // Rekomendasi dokter (3 dokter aktif random)
        $dokters = Dokter::with('user')
            ->where('status', 'aktif')
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.pasien.dashboard', compact(
            'pasien', 'user', 'stats', 'janjiTemu', 'riwayatTerbaru', 'dokters'
        ));
    }

    // ==================== PROFILE ====================
    public function profile()
    {
        $pasien = $this->getPasienLogin();
        $user   = Auth::user();
        return view('pages.pasien.profile', compact('pasien', 'user'));
    }

    public function updateProfile(Request $request)
    {
        $user   = Auth::user();
        $pasien = $this->getPasienLogin();

        $request->validate([
            'nama'          => 'required|string|min:3|max:100',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'nomor_hp'      => 'nullable|string|min:10|max:15',
            'tanggal_lahir' => 'nullable|date|before:today',
            'alamat'        => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
        ]);

        $user->update([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'nomor_hp'      => $request->nomor_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        $pasien->update([
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
    }

    // ==================== REKAM MEDIS ====================
    public function rekamMedis()
    {
        $pasien = $this->getPasienLogin();

        $rekamMedis = RekamMedis::with(['konsultasi.dokter.user', 'konsultasi.jadwal'])
            ->whereHas('konsultasi', function ($q) use ($pasien) {
                $q->where('pasien_id', $pasien->id);
            })
            ->latest()
            ->paginate(10);

        return view('pages.pasien.rekam-medis', compact('rekamMedis'));
    }

    public function detailRekamMedis($id)
    {
        $pasien = $this->getPasienLogin();

        $rekamMedis = RekamMedis::with(['konsultasi.dokter.user', 'konsultasi.jadwal'])
            ->whereHas('konsultasi', function ($q) use ($pasien) {
                $q->where('pasien_id', $pasien->id);
            })
            ->findOrFail($id);

        return view('pages.pasien.rekam-medis-detail', compact('rekamMedis'));
    }
}