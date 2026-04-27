<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        // Data dummy dokter
        $dokters = [
            [
                'id' => 1,
                'nama' => 'dr. Andi Wijaya, Sp.PD',
                'spesialis' => 'Penyakit Dalam',
                'foto' => 'https://randomuser.me/api/portraits/men/1.jpg',
                'pengalaman' => '10 tahun',
                'rating' => 4.8,
                'pasien' => 1200,
                'jadwal' => 'Senin - Jumat, 09:00 - 17:00',
                'telepon' => '0812-3456-7890',
                'email' => 'dr.andi@klinikdigital.com',
                'deskripsi' => 'Dokter spesialis penyakit dalam berpengalaman dalam menangani berbagai keluhan kesehatan internal.'
            ],
            [
                'id' => 2,
                'nama' => 'dr. Siti Rahma, Sp.A',
                'spesialis' => 'Anak',
                'foto' => 'https://randomuser.me/api/portraits/women/2.jpg',
                'pengalaman' => '8 tahun',
                'rating' => 4.9,
                'pasien' => 950,
                'jadwal' => 'Senin - Sabtu, 08:00 - 15:00',
                'telepon' => '0812-3456-7891',
                'email' => 'dr.siti@klinikdigital.com',
                'deskripsi' => 'Dokter spesialis anak yang ramah dan sabar, ahli dalam menangani tumbuh kembang anak.'
            ],
            [
                'id' => 3,
                'nama' => 'dr. Budi Santoso, Sp.JP',
                'spesialis' => 'Jantung',
                'foto' => 'https://randomuser.me/api/portraits/men/3.jpg',
                'pengalaman' => '15 tahun',
                'rating' => 4.9,
                'pasien' => 2100,
                'jadwal' => 'Selasa - Sabtu, 10:00 - 18:00',
                'telepon' => '0812-3456-7892',
                'email' => 'dr.budi@klinikdigital.com',
                'deskripsi' => 'Dokter spesialis jantung terbaik dengan pengalaman internasional.'
            ],
            [
                'id' => 4,
                'nama' => 'dr. Maya Sari, Sp.M',
                'spesialis' => 'Mata',
                'foto' => 'https://randomuser.me/api/portraits/women/4.jpg',
                'pengalaman' => '7 tahun',
                'rating' => 4.7,
                'pasien' => 750,
                'jadwal' => 'Senin - Kamis, 09:00 - 16:00',
                'telepon' => '0812-3456-7893',
                'email' => 'dr.maya@klinikdigital.com',
                'deskripsi' => 'Dokter spesialis mata yang membantu berbagai masalah penglihatan.'
            ],
            [
                'id' => 5,
                'nama' => 'dr. Rizki Fadillah, Sp.KK',
                'spesialis' => 'Kulit & Kelamin',
                'foto' => 'https://randomuser.me/api/portraits/men/5.jpg',
                'pengalaman' => '6 tahun',
                'rating' => 4.8,
                'pasien' => 890,
                'jadwal' => 'Rabu - Minggu, 11:00 - 19:00',
                'telepon' => '0812-3456-7894',
                'email' => 'dr.rizki@klinikdigital.com',
                'deskripsi' => 'Dokter spesialis kulit yang ahli dalam perawatan kecantikan dan kesehatan kulit.'
            ],
            [
                'id' => 6,
                'nama' => 'dr. Lina Herawati, Sp.OG',
                'spesialis' => 'Kandungan',
                'foto' => 'https://randomuser.me/api/portraits/women/6.jpg',
                'pengalaman' => '12 tahun',
                'rating' => 4.9,
                'pasien' => 1850,
                'jadwal' => 'Senin - Jumat, 08:00 - 20:00',
                'telepon' => '0812-3456-7895',
                'email' => 'dr.lina@klinikdigital.com',
                'deskripsi' => 'Dokter spesialis kandungan dengan pelayanan terbaik untuk ibu hamil.'
            ],
        ];

        return view('dokter', compact('dokters'));
    }
}
