<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterDashboardController extends Controller
{
    public function index()
    {
        // Data dummy pasien yang request konsultasi
        $pasienRequests = [
            [
                'id' => 1,
                'nama' => 'Ahmad Sudrajat',
                'usia' => 35,
                'keluhan' => 'Demam dan batuk selama 3 hari',
                'tanggal' => '2024-05-20',
                'jam' => '10:00',
                'status' => 'menunggu',
                'no_antrian' => 1
            ],
            [
                'id' => 2,
                'nama' => 'Siti Aminah',
                'usia' => 28,
                'keluhan' => 'Sakit kepala sebelah kanan',
                'tanggal' => '2024-05-20',
                'jam' => '11:00',
                'status' => 'menunggu',
                'no_antrian' => 2
            ],
            [
                'id' => 3,
                'nama' => 'Budi Santoso',
                'usia' => 42,
                'keluhan' => 'Nyeri ulu hati',
                'tanggal' => '2024-05-20',
                'jam' => '13:00',
                'status' => 'menunggu',
                'no_antrian' => 3
            ],
            [
                'id' => 4,
                'nama' => 'Rina Wati',
                'usia' => 25,
                'keluhan' => 'Alergi kulit',
                'tanggal' => '2024-05-21',
                'jam' => '09:00',
                'status' => 'terjadwal',
                'no_antrian' => 1
            ],
        ];
        
        // Data status dokter (aktif/tidak aktif)
        $dokterStatus = 'aktif'; // bisa 'aktif' atau 'tidak_aktif'
        
        // Data jadwal dokter
        $jadwalDokter = [
            'senin' => ['aktif' => true, 'jam_mulai' => '09:00', 'jam_selesai' => '17:00'],
            'selasa' => ['aktif' => true, 'jam_mulai' => '09:00', 'jam_selesai' => '17:00'],
            'rabu' => ['aktif' => true, 'jam_mulai' => '09:00', 'jam_selesai' => '17:00'],
            'kamis' => ['aktif' => true, 'jam_mulai' => '09:00', 'jam_selesai' => '17:00'],
            'jumat' => ['aktif' => true, 'jam_mulai' => '09:00', 'jam_selesai' => '16:00'],
            'sabtu' => ['aktif' => false, 'jam_mulai' => '', 'jam_selesai' => ''],
            'minggu' => ['aktif' => false, 'jam_mulai' => '', 'jam_selesai' => ''],
        ];
        
        return view('pages.dokter.dashboard', compact('pasienRequests', 'dokterStatus', 'jadwalDokter'));
    }
    
    // Update status dokter (aktif/tidak aktif)
    public function updateStatus(Request $request)
    {
        $status = $request->status;
        // Simpan ke database
        return redirect()->back()->with('success', 'Status berhasil diupdate');
    }
    
    // Update jadwal dokter
    public function updateJadwal(Request $request)
    {
        // Validasi
        $request->validate([
            'hari' => 'required',
            'aktif' => 'required|boolean',
            'jam_mulai' => 'required_if:aktif,1',
            'jam_selesai' => 'required_if:aktif,1'
        ]);
        
        // Simpan ke database
        return redirect()->back()->with('success', 'Jadwal berhasil diupdate');
    }
    
    // Mulai konsultasi dengan pasien
    public function mulaiKonsultasi($id)
    {
        // Proses mulai konsultasi
        return redirect()->back()->with('success', 'Konsultasi dimulai');
    }
    
    // Selesai konsultasi
    public function selesaiKonsultasi($id)
    {
        // Proses selesai konsultasi
        return redirect()->back()->with('success', 'Konsultasi selesai');
    }
}