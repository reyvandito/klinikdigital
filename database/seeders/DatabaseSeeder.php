<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== ADMIN ====================
        User::create([
            'nama'          => 'Admin Klinik',
            'email'         => 'admin@klinik.com',
            'password'      => Hash::make('admin123'),
            'nomor_hp'      => '08111000001',
            'role'          => 'admin',
            'jenis_kelamin' => 'L',
        ]);

        // ==================== DOKTER ====================
        $dokterData = [
            ['nama' => 'dr. Andi Wijaya', 'email' => 'andi.dokter@klinik.com', 'spesialis' => 'Sp.PD - Penyakit Dalam', 'no_str' => 'STR-001-2024', 'jenis_kelamin' => 'L'],
            ['nama' => 'dr. Siti Rahma', 'email' => 'siti.dokter@klinik.com', 'spesialis' => 'Sp.A - Spesialis Anak', 'no_str' => 'STR-002-2024', 'jenis_kelamin' => 'P'],
            ['nama' => 'dr. Budi Santoso', 'email' => 'budi.dokter@klinik.com', 'spesialis' => 'Sp.JP - Spesialis Jantung', 'no_str' => 'STR-003-2024', 'jenis_kelamin' => 'L'],
        ];

        foreach ($dokterData as $data) {
            $user = User::create([
                'nama'          => $data['nama'],
                'email'         => $data['email'],
                'password'      => Hash::make('dokter123'),
                'nomor_hp'      => '0812' . rand(10000000, 99999999),
                'role'          => 'dokter',
                'jenis_kelamin' => $data['jenis_kelamin'],
            ]);

            $dokter = Dokter::create([
                'user_id'   => $user->id,
                'spesialis' => $data['spesialis'],
                'no_str'    => $data['no_str'],
                'status'    => 'aktif',
            ]);

            // Buat jadwal 7 hari ke depan
            for ($i = 0; $i < 7; $i++) {
                $tanggal = now()->addDays($i);
                if ($tanggal->dayOfWeek === 0) continue; // Skip Minggu

                Jadwal::create([
                    'dokter_id'   => $dokter->id,
                    'tanggal'     => $tanggal->format('Y-m-d'),
                    'jam_mulai'   => '09:00',
                    'jam_selesai' => '12:00',
                    'kuota'       => 10,
                    'sisa_kuota'  => 10, // ← WAJIB diisi
                    'status'      => 'tersedia', // ← WAJIB diisi
                ]);

                Jadwal::create([
                    'dokter_id'   => $dokter->id,
                    'tanggal'     => $tanggal->format('Y-m-d'),
                    'jam_mulai'   => '13:00',
                    'jam_selesai' => '17:00',
                    'kuota'       => 10,
                    'sisa_kuota'  => 10,
                    'status'      => 'tersedia',
                ]);
            }
        }

        // ==================== PASIEN ====================
        $userPasien1 = User::create([
            'nama'          => 'Ahmad Sudrajat',
            'email'         => 'ahmad@pasien.com',
            'password'      => Hash::make('pasien123'),
            'nomor_hp'      => '08211000001',
            'role'          => 'pasien',
            'jenis_kelamin' => 'L',
        ]);
        Pasien::create(['user_id' => $userPasien1->id, 'tanggal_lahir' => '1990-05-15', 'alamat' => 'Jl. Merdeka No. 10, Batam']);

        $userPasien2 = User::create([
            'nama'          => 'Siti Aminah',
            'email'         => 'siti@pasien.com',
            'password'      => Hash::make('pasien123'),
            'nomor_hp'      => '08211000002',
            'role'          => 'pasien',
            'jenis_kelamin' => 'P',
        ]);
        Pasien::create(['user_id' => $userPasien2->id, 'tanggal_lahir' => '1995-08-22', 'alamat' => 'Jl. Sudirman No. 5, Batam']);

        $this->command->info('✅ Seeder selesai!');
        $this->command->info('Admin  : admin@klinik.com / admin123');
        $this->command->info('Dokter : andi.dokter@klinik.com / dokter123');
        $this->command->info('Pasien : ahmad@pasien.com / pasien123');
    }
}