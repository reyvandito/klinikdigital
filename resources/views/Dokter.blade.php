@extends('layouts.home')

@section('title', 'Dokter Kami - Klinik Digital')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Tim Dokter Kami</h1>
        <p class="text-xl text-gray-600">Dokter-dokter profesional siap memberikan pelayanan terbaik untuk Anda</p>
    </div>

    <!-- Grid Dokter -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($dokters as $dokter)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <!-- Foto Dokter -->
            <div class="relative">
                <img src="{{ $dokter['foto'] }}" alt="{{ $dokter['nama'] }}" class="w-full h-64 object-cover">
                <div class="absolute top-4 right-4 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-lg text-sm font-semibold">
                    <i class="fas fa-star mr-1"></i> {{ $dokter['rating'] }}
                </div>
            </div>

            <!-- Info Dokter -->
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $dokter['nama'] }}</h3>
                <p class="text-blue-500 font-semibold mb-3">
                    <i class="fas fa-stethoscope mr-1"></i> {{ $dokter['spesialis'] }}
                </p>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-briefcase w-5 text-blue-500"></i>
                        <span>Pengalaman {{ $dokter['pengalaman'] }}</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-users w-5 text-blue-500"></i>
                        <span>{{ $dokter['pasien'] }}+ Pasien</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-clock w-5 text-blue-500"></i>
                        <span>{{ $dokter['jadwal'] }}</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-phone-alt w-5 text-blue-500"></i>
                        <span>{{ $dokter['telepon'] }}</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-envelope w-5 text-blue-500"></i>
                        <span>{{ $dokter['email'] }}</span>
                    </div>
                </div>

                <p class="text-gray-600 text-sm mb-4">
                    {{ $dokter['deskripsi'] }}
                </p>

                <div class="flex gap-2">
                    <a href="#" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-calendar-alt mr-1"></i> Buat Janji
                    </a>
                    <a href="tel:{{ $dokter['telepon'] }}" class="flex-1 border border-green-500 text-green-500 hover:bg-green-500 hover:text-white text-center px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-phone-alt mr-1"></i> Hubungi
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection