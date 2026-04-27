<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ==================== DASHBOARD ====================
    public function index()
    {
        $totalPasien = 1234;
        $totalDokter = 25;
        $totalJanji = 156;
        $dokterPending = 3;
        
        return view('pages.admin.dashboard', compact('totalPasien', 'totalDokter', 'totalJanji', 'dokterPending'));
    }
    
    // ==================== MANAJEMEN DOKTER ====================
    public function dokterIndex()
    {
        $dokters = [
            ['id' => 1, 'nama' => 'dr. Andi Wijaya, Sp.PD', 'spesialis' => 'Penyakit Dalam', 'email' => 'andi@dokter.com', 'telepon' => '081234567890', 'status' => 'approved', 'pengalaman' => 10],
            ['id' => 2, 'nama' => 'dr. Siti Rahma, Sp.A', 'spesialis' => 'Anak', 'email' => 'siti@dokter.com', 'telepon' => '081234567891', 'status' => 'approved', 'pengalaman' => 8],
            ['id' => 3, 'nama' => 'dr. Budi Santoso', 'spesialis' => 'Umum', 'email' => 'budi@dokter.com', 'telepon' => '081234567892', 'status' => 'pending', 'pengalaman' => 3],
            ['id' => 4, 'nama' => 'dr. Maya Sari', 'spesialis' => 'Mata', 'email' => 'maya@dokter.com', 'telepon' => '081234567893', 'status' => 'pending', 'pengalaman' => 2],
        ];
        return view('pages.admin.dokter', compact('dokters'));
    }
    
    public function dokterCreate()
    {
        return view('pages.admin.dokter-form');
    }
    
    public function dokterStore(Request $request)
    {
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }
    
    public function dokterEdit($id)
    {
        return view('pages.admin.dokter-form', compact('id'));
    }
    
    public function dokterUpdate(Request $request, $id)
    {
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil diupdate');
    }
    
    public function dokterDelete($id)
    {
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil dihapus');
    }
    
    public function dokterVerify($id)
    {
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil diverifikasi');
    }
    
    public function dokterReject($id)
    {
        return redirect()->route('admin.dokter.index')->with('warning', 'Dokter ditolak');
    }
    
    // ==================== MANAJEMEN PASIEN ====================
    public function pasienIndex()
    {
        $pasiens = [
            ['id' => 1, 'nama' => 'Ahmad Sudrajat', 'email' => 'ahmad@gmail.com', 'telepon' => '081234567001', 'tanggal_daftar' => '2024-01-15'],
            ['id' => 2, 'nama' => 'Siti Aminah', 'email' => 'siti@gmail.com', 'telepon' => '081234567002', 'tanggal_daftar' => '2024-01-20'],
            ['id' => 3, 'nama' => 'Budi Santoso', 'email' => 'budi@gmail.com', 'telepon' => '081234567003', 'tanggal_daftar' => '2024-02-10'],
            ['id' => 4, 'nama' => 'Rina Wati', 'email' => 'rina@gmail.com', 'telepon' => '081234567004', 'tanggal_daftar' => '2024-03-05'],
        ];
        return view('pages.admin.pasien', compact('pasiens'));
    }
    
    public function pasienCreate()
    {
        return view('pages.admin.pasien-form');
    }
    
    public function pasienStore(Request $request)
    {
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan');
    }
    
    public function pasienEdit($id)
    {
        return view('pages.admin.pasien-form', compact('id'));
    }
    
    public function pasienUpdate(Request $request, $id)
    {
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil diupdate');
    }
    
    public function pasienDelete($id)
    {
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil dihapus');
    }
    
    // ==================== MANAJEMEN JADWAL ====================
    public function jadwalIndex()
    {
        $jadwals = [
            ['id' => 1, 'pasien' => 'Ahmad Sudrajat', 'dokter' => 'dr. Andi Wijaya, Sp.PD', 'tanggal' => '2024-05-20', 'jam' => '10:00', 'status' => 'menunggu'],
            ['id' => 2, 'pasien' => 'Siti Aminah', 'dokter' => 'dr. Siti Rahma, Sp.A', 'tanggal' => '2024-05-20', 'jam' => '11:00', 'status' => 'menunggu'],
            ['id' => 3, 'pasien' => 'Budi Santoso', 'dokter' => 'dr. Andi Wijaya, Sp.PD', 'tanggal' => '2024-05-21', 'jam' => '09:00', 'status' => 'terjadwal'],
            ['id' => 4, 'pasien' => 'Rina Wati', 'dokter' => 'dr. Budi Santoso', 'tanggal' => '2024-05-22', 'jam' => '14:00', 'status' => 'pending'],
        ];
        return view('pages.admin.jadwal', compact('jadwals'));
    }
    
    public function jadwalUpdateStatus(Request $request, $id)
    {
        return redirect()->route('admin.jadwal.index')->with('success', 'Status jadwal berhasil diupdate');
    }
    
    // ==================== MANAJEMEN RESERVASI ====================
    public function reservasiIndex()
    {
        $reservasis = [
            ['id' => 1, 'pasien' => 'Ahmad Sudrajat', 'dokter' => 'dr. Andi Wijaya, Sp.PD', 'tanggal' => '2024-05-20', 'jam' => '10:00', 'keluhan' => 'Demam dan batuk', 'status' => 'menunggu'],
            ['id' => 2, 'pasien' => 'Siti Aminah', 'dokter' => 'dr. Siti Rahma, Sp.A', 'tanggal' => '2024-05-20', 'jam' => '11:00', 'keluhan' => 'Sakit kepala', 'status' => 'terjadwal'],
            ['id' => 3, 'pasien' => 'Budi Santoso', 'dokter' => 'dr. Andi Wijaya, Sp.PD', 'tanggal' => '2024-05-21', 'jam' => '09:00', 'keluhan' => 'Nyeri ulu hati', 'status' => 'selesai'],
            ['id' => 4, 'pasien' => 'Rina Wati', 'dokter' => 'dr. Budi Santoso', 'tanggal' => '2024-05-21', 'jam' => '14:00', 'keluhan' => 'Alergi kulit', 'status' => 'batal'],
        ];
        return view('pages.admin.reservasi', compact('reservasis'));
    }
    
    public function reservasiDetail($id)
    {
        return view('pages.admin.reservasi-detail', compact('id'));
    }
    
    public function reservasiUpdateStatus(Request $request, $id)
    {
        return redirect()->route('admin.reservasi.index')->with('success', 'Status reservasi berhasil diupdate');
    }
    
    public function reservasiDelete($id)
    {
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil dihapus');
    }
    
    // ==================== PROFILE ADMIN ====================
    public function profileIndex()
    {
        $admins = [
            ['id' => 2, 'nama' => 'Budi Santoso', 'email' => 'budi@admin.com', 'role' => 'Administrator', 'status' => 'aktif'],
            ['id' => 3, 'nama' => 'Siti Aminah', 'email' => 'siti@admin.com', 'role' => 'Operator', 'status' => 'aktif'],
            ['id' => 4, 'nama' => 'Ahmad Sudrajat', 'email' => 'ahmad@admin.com', 'role' => 'Administrator', 'status' => 'nonaktif'],
        ];
        return view('pages.admin.profile', compact('admins'));
    }
    
    public function profileUpdate(Request $request)
    {
        return redirect()->route('admin.profile')->with('success', 'Profile berhasil diupdate');
    }
    
    // ==================== PENGATURAN ====================
    public function settingsIndex()
    {
        return view('pages.admin.settings');
    }
    
    public function settingsUpdate(Request $request)
    {
        return redirect()->route('admin.settings')->with('success', 'Pengaturan berhasil disimpan');
    }
}