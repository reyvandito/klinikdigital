<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Admin Klinik',
            'email' => 'admin@klinik.com',
            'nomor_hp' => '08123456789',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'jenis_kelamin' => 'L',
        ]);
    }
}