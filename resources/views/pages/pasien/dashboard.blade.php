@extends('layouts.pasien')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- ==================== HERO/WELCOME SECTION ==================== -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-6 mb-8 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold mb-2">Halo, Pasien! 👋</h1>
                <p class="text-blue-100">Selamat datang di Klinik Digital. Kesehatan Anda adalah prioritas kami.</p>
                <div class="mt-4 flex gap-3">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">🏥 Terdaftar sejak 2024</span>
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">🩺 3x Konsultasi</span>
                </div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-heartbeat text-7xl text-white/30"></i>
            </div>
        </div>
    </div>

    <!-- ==================== STATISTIK CARD ==================== -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl p-4 shadow-sm border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Janji Temu</p>
                    <p class="text-2xl font-bold text-gray-800">2</p>
                    <p class="text-green-500 text-xs">Aktif</p>
                </div>
                <i class="fas fa-calendar-check text-2xl text-blue-500"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Konsultasi</p>
                    <p class="text-2xl font-bold text-gray-800">8</p>
                    <p class="text-gray-500 text-xs">Total</p>
                </div>
                <i class="fas fa-history text-2xl text-green-500"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Resep Obat</p>
                    <p class="text-2xl font-bold text-gray-800">3</p>
                    <p class="text-gray-500 text-xs">Aktif</p>
                </div>
                <i class="fas fa-prescription text-2xl text-purple-500"></i>
            </div>
        </div>
    </div>

    <!-- ==================== MENU CEPAT ==================== -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
        <a href="{{ route('pasien.reservasi.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 text-center text-white shadow-md hover:shadow-lg transition transform hover:scale-105">
            <i class="fas fa-calendar-plus text-2xl mb-2 block"></i>
            <span class="text-sm font-medium">Buat Janji</span>
        </a>
        <a href="{{ route('dokter') }}" class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-4 text-center text-white shadow-md hover:shadow-lg transition transform hover:scale-105">
            <i class="fas fa-user-md text-2xl mb-2 block"></i>
            <span class="text-sm font-medium">Cari Dokter</span>
        </a>
        <a href="{{ route('pasien.riwayat') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-4 text-center text-white shadow-md hover:shadow-lg transition transform hover:scale-105">
            <i class="fas fa-history text-2xl mb-2 block"></i>
            <span class="text-sm font-medium">Riwayat</span>
        </a>
        <a href="#" class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-4 text-center text-white shadow-md hover:shadow-lg transition transform hover:scale-105">
            <i class="fas fa-file-medical text-2xl mb-2 block"></i>
            <span class="text-sm font-medium">Rekam Medis</span>
        </a>
    </div>

    <!-- ==================== JANJI TEMU & REKOMENDASI DOKTER ==================== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Janji Temu Terdekat -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-yellow-50 px-5 py-3 border-b">
                <h2 class="font-bold text-gray-800 flex items-center">
                    <i class="fas fa-clock text-yellow-500 mr-2"></i> Janji Temu Terdekat
                </h2>
            </div>
            <div class="p-5">
                <div class="flex items-center gap-4 border-b pb-4 mb-4">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-md text-2xl text-blue-500"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">dr. Andi Wijaya, Sp.PD</p>
                        <p class="text-sm text-gray-500">Spesialis Penyakit Dalam</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs text-gray-500"><i class="far fa-calendar mr-1"></i>Senin, 20 Mei 2024</span>
                            <span class="text-xs text-gray-500"><i class="far fa-clock mr-1"></i>10:00</span>
                        </div>
                    </div>
                    <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">Menunggu</span>
                </div>
                <a href="{{ route('pasien.reservasi.create') }}" class="text-blue-500 text-sm hover:underline">
                    + Buat Janji Temu Baru
                </a>
            </div>
        </div>

        <!-- Rekomendasi Dokter -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-green-50 px-5 py-3 border-b">
                <h2 class="font-bold text-gray-800 flex items-center">
                    <i class="fas fa-star text-yellow-500 mr-2"></i> Rekomendasi Dokter
                </h2>
            </div>
            <div class="p-5 space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-md text-pink-500"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">dr. Siti Rahma, Sp.A</p>
                        <p class="text-xs text-gray-500">Spesialis Anak · Rating 4.9</p>
                    </div>
                    <a href="{{ route('dokter') }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg text-xs">Pilih</a>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-md text-blue-500"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">dr. Budi Santoso, Sp.JP</p>
                        <p class="text-xs text-gray-500">Spesialis Jantung · Rating 4.8</p>
                    </div>
                    <a href="{{ route('dokter') }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg text-xs">Pilih</a>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-md text-purple-500"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">dr. Maya Sari, Sp.M</p>
                        <p class="text-xs text-gray-500">Spesialis Mata · Rating 4.7</p>
                    </div>
                    <a href="{{ route('dokter') }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg text-xs">Pilih</a>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3 text-center">
                <a href="{{ route('dokter') }}" class="text-blue-500 text-sm hover:underline">Lihat Semua Dokter →</a>
            </div>
        </div>
    </div>

    <!-- ==================== TIPS KESEHATAN ==================== -->
    <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-xl p-5 mb-8 border border-blue-100">
        <h2 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> Tips Kesehatan Hari Ini
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="flex items-start gap-3">
                <i class="fas fa-apple-alt text-green-500 text-xl"></i>
                <div>
                    <p class="font-medium text-gray-800">Jaga Pola Makan</p>
                    <p class="text-xs text-gray-500">Perbanyak sayur dan buah setiap hari</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <i class="fas fa-walking text-blue-500 text-xl"></i>
                <div>
                    <p class="font-medium text-gray-800">Olahraga Ringan</p>
                    <p class="text-xs text-gray-500">30 menit setiap hari cukup</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <i class="fas fa-bed text-purple-500 text-xl"></i>
                <div>
                    <p class="font-medium text-gray-800">Istirahat Cukup</p>
                    <p class="text-xs text-gray-500">Tidur 7-8 jam per hari</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== RIWAYAT KONSULTASI TERBARU ==================== -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gray-50 px-5 py-3 border-b flex justify-between items-center">
            <h2 class="font-bold text-gray-800 flex items-center">
                <i class="fas fa-history text-gray-500 mr-2"></i> Riwayat Konsultasi Terbaru
            </h2>
            <a href="{{ route('pasien.riwayat') }}" class="text-blue-500 text-sm hover:underline">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 text-xs text-gray-500">
                    <tr>
                        <th class="px-5 py-3 text-left">Tanggal</th>
                        <th class="px-5 py-3 text-left">Dokter</th>
                        <th class="px-5 py-3 text-left">Spesialis</th>
                        <th class="px-5 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 text-sm">10 Mei 2024</td>
                        <td class="px-5 py-3 font-medium text-sm">dr. Andi Wijaya</td>
                        <td class="px-5 py-3 text-sm">Penyakit Dalam</td>
                        <td class="px-5 py-3"><span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Selesai</span></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 text-sm">25 April 2024</td>
                        <td class="px-5 py-3 font-medium text-sm">dr. Siti Rahma</td>
                        <td class="px-5 py-3 text-sm">Anak</td>
                        <td class="px-5 py-3"><span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Selesai</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection