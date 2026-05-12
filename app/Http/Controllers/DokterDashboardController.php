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
        $dokterStatus = 'aktif';
        
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

    // ==================== REKAM MEDIS ====================
public function rekamMedisIndex()
{
    return view('pages.dokter.rekam-medis.index');
}

public function rekamMedisCreate()
{
    return view('pages.dokter.rekam-medis.create');
}

public function rekamMedisEdit(Request $request)
{
    $id = $request->query('id');
    return view('pages.dokter.rekam-medis.edit', compact('id'));
}

public function rekamMedisStore(Request $request)
{
    return redirect()->route('dokter.rekam-medis.index')->with('success', 'Rekam medis berhasil disimpan');
}

public function rekamMedisUpdate(Request $request, $id)
{
    return redirect()->route('dokter.rekam-medis.index')->with('success', 'Rekam medis berhasil diupdate');
}

public function rekamMedisDelete($id)
{
    return redirect()->route('dokter.rekam-medis.index')->with('success', 'Rekam medis berhasil dihapus');
}

public function rekamMedisShow($id)
{
    return view('pages.dokter.rekam-medis.show', compact('id'));
}
    
    public function updateStatus(Request $request)
    {
        return redirect()->back()->with('success', 'Status berhasil diupdate');
    }
    
    public function updateJadwal(Request $request)
    {
        return redirect()->back()->with('success', 'Jadwal berhasil diupdate');
    }
    
    public function mulaiKonsultasi($id)
    {
        return redirect()->back()->with('success', 'Konsultasi dimulai');
    }
    
    public function selesaiKonsultasi($id)
    {
        return redirect()->back()->with('success', 'Konsultasi selesai');
    }

// ==================== DAFTAR PASIEN ====================
public function daftarPasien()
{
    return view('pages.dokter.pasien');
}

public function detailPasien($id)
{
    return view('pages.dokter.pasien-detail', compact('id'));
}

public function simpanCatatan(Request $request, $id)
{
    return redirect()->back()->with('success', 'Catatan berhasil disimpan');
}

}