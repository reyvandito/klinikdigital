@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="space-y-8">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Selamat Datang, Dokter! 👋</h1>
                <p class="text-blue-100">Kelola jadwal praktik dan pasien Anda dengan mudah.</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-user-md text-6xl text-white opacity-50"></i>
            </div>
        </div>
    </div>
    
    <!-- Quick Menu -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('dokter.rekam-medis.create') }}" class="bg-green-500 hover:bg-green-600 rounded-lg p-4 text-center text-white transition">
            <i class="fas fa-plus-circle text-2xl mb-2 block"></i>
            <span class="font-semibold">Buat Rekam Medis</span>
        </a>
        <a href="{{ route('dokter.rekam-medis.index') }}" class="bg-blue-500 hover:bg-blue-600 rounded-lg p-4 text-center text-white transition">
            <i class="fas fa-file-medical text-2xl mb-2 block"></i>
            <span class="font-semibold">Lihat Rekam Medis</span>
        </a>
        <a href="{{ route('dokter.pasien.index') }}" class="bg-purple-500 hover:bg-purple-600 rounded-lg p-4 text-center text-white transition">
            <i class="fas fa-users text-2xl mb-2 block"></i>
            <span class="font-semibold">Daftar Pasien</span>
        </a>
    </div>
    
    <!-- Status & Jadwal Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-dokter.status-card />
        <x-dokter.jadwal-card />
    </div>
    
    <x-dokter.pasien-list />
</div>

<x-dokter.modal-jadwal />
<x-dokter.modal-detail-pasien />
@endsection