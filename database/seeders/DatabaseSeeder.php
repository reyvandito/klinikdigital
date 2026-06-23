<?php

namespace Database\Seeders;

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
        $this->command->info('Pasien : ahmad@pasien.com / pasien123');
        $this->command->info('Pasien : siti@pasien.com / pasien123');
        $this->command->info('');
        $this->command->info('⚠️  Data dokter sudah dihapus dari seeder.');
        $this->command->info('   Silakan tambah dokter dari dashboard admin.');
    }
}