@extends('layouts.home')

@section('title', 'Klinik Digital - Layanan Kesehatan Modern')

@section('content')
<div class="container mx-auto px-4 mt-5">
    <!-- Hero Section -->
    <div class="max-w-4xl mx-auto text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <span class="text-blue-500">Selamat Datang di</span>
            <span class="text-green-500">Klinik Digital</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8">Solusi kesehatan modern untuk keluarga Anda</p>
        <div class="flex justify-center gap-4">
            <x-button variant="blue">
                Buat Janji
            </x-button>
        </div>
    </div>

    <!-- Features Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-5 pt-5">
        <x-card icon="clock" title="Pelayanan 24/7">
            Layanan kesehatan siap membantu Anda kapan saja
        </x-card>

        <x-card icon="user-md" title="Dokter Profesional">
            Tim dokter berpengalaman di bidangnya
        </x-card>

        <x-card icon="prescription-bottle" title="Obat Lengkap">
            Tersedia berbagai jenis obat berkualitas
        </x-card>
    </div>

    <!-- Statistik Section -->
    <div class="bg-gray-100 rounded-2xl p-8 mt-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <x-stats number="1000+" label="Pasien Puas" />
            <x-stats number="20+" label="Dokter Spesialis" />
            <x-stats number="50+" label="Layanan Medis" />
            <x-stats number="24/7" label="Jam Layanan" />
        </div>
    </div>
</div>
@endsection