@extends('layouts.admin')

@section('title', 'Info Klinik')
@section('page-title', 'Info Seputar Klinik')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <!-- Info Klinik -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Info Klinik</h2>
<div class="space-y-4">

    <div>
        <p class="text-sm text-gray-500 mb-1">Nama Klinik</p>
        <input type="text"
               value="Klinik Digital Sehat"
               readonly
               class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">
    </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Alamat Klinik</p>
            <input type="text"
                value="Jl. Kesehatan No. 123, Jakarta"
                readonly
                class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Telepon Klinik</p>
            <input type="text"
                value="(021) 1234-5678"
                readonly
                class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Email Klinik</p>
            <input type="email"
                value="info@klinikdigital.com"
                readonly
                class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">
        </div>

    </div>
    </div>
    
    <!-- Pengaturan Jam Operasional -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Jam Operasional</h2>
            <div class="grid grid-cols-3 items-center text-center py-3">
                <div class="font-medium">
                    Senin - Jumat
                </div>

                <div>
                    09:00 - 17:00
                </div>
            </div>

            <div class="grid grid-cols-3 items-center text-center py-3">
                <div class="font-medium">
                    Sabtu
                </div>

                <div>
                    09:00 - 14:00
                </div>
            </div>

            <div class="grid grid-cols-3 items-center text-center py-3">
                <div class="font-medium">
                    Minggu
                </div>

                <div>
                    Tutup
                </div>
            </div>
        </div>
    </div>
    
    <!-- Informasi Klinik -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-bold mb-4">Versi Sistem</h2>

        <div class="grid grid-cols-2 gap-y-4">
            <div class="font-medium text-gray-600">Nama Sistem</div>
            <div>Klinik Digital</div>

            <div class="font-medium text-gray-600">Versi Aplikasi</div>
            <div>v1.0.0</div>

            <div class="font-medium text-gray-600">Framework</div>
            <div>Laravel 12</div>

            <div class="font-medium text-gray-600">Bahasa Pemrograman</div>
            <div>PHP 8.2</div>

            <div class="font-medium text-gray-600">Database</div>
            <div>MySQL</div>

            <div class="font-medium text-gray-600">Frontend</div>
            <div>Blade, Tailwind CSS, Font Awesome</div>

            <div class="font-medium text-gray-600">Pengembang</div>
            <div>{{ auth()->user()->nama ?? 'Tim PBL Klinik Digital' }}</div>

            <div class="font-medium text-gray-600">Tahun Pengembangan</div>
            <div>2026</div>
        </div>
    </div>
</div>
@endsection