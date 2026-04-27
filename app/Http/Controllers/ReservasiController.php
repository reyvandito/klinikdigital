<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    // Halaman form reservasi
    public function create()
    {
        // Data dummy dokter
        $dokters = [
            ['id' => 1, 'nama' => 'dr. Andi Wijaya, Sp.PD', 'spesialis' => 'Penyakit Dalam'],
            ['id' => 2, 'nama' => 'dr. Siti Rahma, Sp.A', 'spesialis' => 'Anak'],
            ['id' => 3, 'nama' => 'dr. Budi Santoso, Sp.JP', 'spesialis' => 'Jantung'],
            ['id' => 4, 'nama' => 'dr. Maya Sari, Sp.M', 'spesialis' => 'Mata'],
            ['id' => 5, 'nama' => 'dr. Rizki Fadillah, Sp.KK', 'spesialis' => 'Kulit & Kelamin'],
            ['id' => 6, 'nama' => 'dr. Lina Herawati, Sp.OG', 'spesialis' => 'Kandungan'],
        ];
        
        return view('pages.pasien.reservasi', compact('dokters'));
    }
    
    // Proses simpan reservasi
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'dokter_id' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'keluhan' => 'required|min:10'
        ]);
        
        // Simulasi simpan ke database
        // Reservasi::create($request->all());
        
        // Redirect ke halaman success dengan session success
        return redirect()->route('pasien.reservasi.success')
                         ->with('success', 'Reservasi berhasil dibuat!');
    }
    
    // Halaman sukses
    public function success()
    {
        return view('pages.pasien.reservasi-success');
    }
    
    // Halaman riwayat reservasi
    public function riwayat()
    {
        // Data dummy riwayat reservasi
        $reservasis = [
            [
                'id' => 1,
                'dokter_nama' => 'dr. Andi Wijaya, Sp.PD',
                'tanggal' => '2024-05-20',
                'jam' => '10:00',
                'status' => 'selesai',
                'keluhan' => 'Demam dan batuk'
            ],
            [
                'id' => 2,
                'dokter_nama' => 'dr. Siti Rahma, Sp.A',
                'tanggal' => '2024-05-25',
                'jam' => '14:00',
                'status' => 'menunggu',
                'keluhan' => 'Anak demam tinggi'
            ],
        ];
        
        return view('pages.pasien.riwayat-reservasi', compact('reservasis'));
    }
    
    // Batalkan reservasi
    public function batal($id)
    {
        return redirect()->route('pasien.riwayat')
                         ->with('success', 'Reservasi berhasil dibatalkan');
    }
    
    // Detail riwayat
    public function detailRiwayat($id)
    {
        return view('pages.pasien.riwayat-detail', compact('id'));
    }
}