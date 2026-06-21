@extends('layouts.home')

@section('content')
<!-- ==================== HERO SECTION ==================== -->
<div class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="container mx-auto px-4 py-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                Dokter Kami
            </h1>
            <p class="text-lg text-blue-100">Dokter-dokter profesional siap memberikan pelayanan terbaik untuk Anda</p>
        </div>
    </div>
</div>

<!-- ==================== DOKTER LIST ==================== -->
<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($dokters as $dokter)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            {{-- GANTI: pakai $dokter->foto_url --}}
            <img src="{{ $dokter->foto_url }}" 
                 alt="{{ $dokter->user->nama }}" 
                 class="w-full h-56 object-cover">
            <div class="p-5">
                <h3 class="text-xl font-bold mb-1">{{ $dokter->user->nama }}</h3>
                <p class="text-blue-500 text-sm mb-2">{{ $dokter->spesialis }}</p>
                <p class="text-gray-500 text-sm">
                    <i class="fas fa-phone mr-1"></i> {{ $dokter->user->nomor_hp ?? 'Tersedia' }}
                </p>
                <a href="{{ route('login') }}" class="mt-4 inline-block w-full text-center bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 transition">
                    Buat Janji
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-10">
            <p class="text-gray-500">Belum ada data dokter. Silakan cek kembali nanti.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection