@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold mb-2">Selamat Datang, Admin!</h1>
            <p class="text-blue-100">Kelola dokter, pasien, dan jadwal konsultasi dengan mudah.</p>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-chart-line text-6xl text-white opacity-50"></i>
        </div>
    </div>
</div>

<!-- Statistik Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Pasien</p>
                <p class="text-2xl font-bold text-gray-800">1,234</p>
                <p class="text-green-500 text-xs mt-1">
                    <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                </p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-xl text-blue-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Dokter</p>
                <p class="text-2xl font-bold text-gray-800">25</p>
                <p class="text-green-500 text-xs mt-1">
                    <i class="fas fa-arrow-up"></i> 3 dokter baru
                </p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user-md text-xl text-green-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Janji Temu</p>
                <p class="text-2xl font-bold text-gray-800">156</p>
                <p class="text-yellow-500 text-xs mt-1">
                    <i class="fas fa-clock"></i> 23 menunggu
                </p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-calendar-check text-xl text-purple-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Pendapatan</p>
                <p class="text-2xl font-bold text-gray-800">Rp 50M</p>
                <p class="text-green-500 text-xs mt-1">
                    <i class="fas fa-arrow-up"></i> 8% dari bulan lalu
                </p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-money-bill text-xl text-yellow-500"></i>
            </div>
        </div>
    </div>
</div>

<!-- Menu Cepat -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <a href="{{ route('admin.dokter.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md p-6 hover:shadow-lg transition-all">
        <div class="flex items-center justify-between text-white">
            <div>
                <i class="fas fa-user-md text-4xl mb-2"></i>
                <h3 class="text-xl font-bold">Kelola Dokter</h3>
                <p class="text-sm opacity-90">Tambah, edit, hapus dokter</p>
            </div>
            <i class="fas fa-arrow-right text-2xl"></i>
        </div>
    </a>
    
    <a href="{{ route('admin.pasien.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md p-6 hover:shadow-lg transition-all">
        <div class="flex items-center justify-between text-white">
            <div>
                <i class="fas fa-users text-4xl mb-2"></i>
                <h3 class="text-xl font-bold">Kelola Pasien</h3>
                <p class="text-sm opacity-90">Tambah, edit, hapus pasien</p>
            </div>
            <i class="fas fa-arrow-right text-2xl"></i>
        </div>
    </a>
    
    <a href="{{ route('admin.jadwal.index') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-md p-6 hover:shadow-lg transition-all">
        <div class="flex items-center justify-between text-white">
            <div>
                <i class="fas fa-calendar-alt text-4xl mb-2"></i>
                <h3 class="text-xl font-bold">Kelola Jadwal</h3>
                <p class="text-sm opacity-90">Lihat & kelola jadwal</p>
            </div>
            <i class="fas fa-arrow-right text-2xl"></i>
        </div>
    </a>
</div>

<!-- Dokter Menunggu Verifikasi -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">
            <i class="fas fa-clock text-orange-500 mr-2"></i>
            Dokter Menunggu Verifikasi
        </h2>
        <a href="{{ route('admin.dokter.index') }}" class="text-blue-500 hover:text-blue-600 text-sm">Lihat semua →</a>
    </div>
    
    <div class="space-y-3">
        <div class="flex items-center justify-between border rounded-lg p-4 bg-yellow-50">
            <div>
                <p class="font-semibold text-gray-800">dr. Budi Santoso</p>
                <p class="text-sm text-gray-600">Spesialis Umum | budi@dokter.com</p>
            </div>
            <div class="flex space-x-2">
                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm">
                    <i class="fas fa-check mr-1"></i> Verifikasi
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                    <i class="fas fa-times mr-1"></i> Tolak
                </button>
            </div>
        </div>
        <div class="flex items-center justify-between border rounded-lg p-4 bg-yellow-50">
            <div>
                <p class="font-semibold text-gray-800">dr. Maya Sari</p>
                <p class="text-sm text-gray-600">Spesialis Mata | maya@dokter.com</p>
            </div>
            <div class="flex space-x-2">
                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm">
                    <i class="fas fa-check mr-1"></i> Verifikasi
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                    <i class="fas fa-times mr-1"></i> Tolak
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Aktivitas Terbaru & Jadwal Hari Ini -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Aktivitas Terbaru</h2>
        <div class="space-y-3">
            <div class="flex items-center justify-between border-b pb-3">
                <div>
                    <p class="font-semibold">Pasien baru mendaftar</p>
                    <p class="text-sm text-gray-500">Ahmad Sudrajat</p>
                </div>
                <span class="text-sm text-gray-400">5 menit lalu</span>
            </div>
            <div class="flex items-center justify-between border-b pb-3">
                <div>
                    <p class="font-semibold">Janji temu baru</p>
                    <p class="text-sm text-gray-500">Dengan dr. Andi Wijaya</p>
                </div>
                <span class="text-sm text-gray-400">1 jam lalu</span>
            </div>
            <div class="flex items-center justify-between border-b pb-3">
                <div>
                    <p class="font-semibold">Dokter baru mendaftar</p>
                    <p class="text-sm text-gray-500">dr. Budi Santoso</p>
                </div>
                <span class="text-sm text-gray-400">2 jam lalu</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Jadwal Hari Ini</h2>
        <div class="space-y-3">
            <div class="flex items-center justify-between border-b pb-3">
                <div>
                    <p class="font-semibold">dr. Andi Wijaya</p>
                    <p class="text-sm text-gray-500">Pasien: Ahmad Sudrajat</p>
                </div>
                <span class="text-sm text-blue-600">10:00</span>
            </div>
            <div class="flex items-center justify-between border-b pb-3">
                <div>
                    <p class="font-semibold">dr. Siti Rahma</p>
                    <p class="text-sm text-gray-500">Pasien: Siti Aminah</p>
                </div>
                <span class="text-sm text-blue-600">11:00</span>
            </div>
            <div class="flex items-center justify-between border-b pb-3">
                <div>
                    <p class="font-semibold">dr. Andi Wijaya</p>
                    <p class="text-sm text-gray-500">Pasien: Budi Santoso</p>
                </div>
                <span class="text-sm text-blue-600">14:00</span>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.jadwal.index') }}" class="text-blue-500 hover:text-blue-600 text-sm">Lihat semua jadwal →</a>
        </div>
    </div>
</div>
@endsection