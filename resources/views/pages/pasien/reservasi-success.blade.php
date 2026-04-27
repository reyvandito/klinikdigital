@extends('layouts.pasien')

@section('title', 'Reservasi Berhasil - Klinik Digital')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="mb-4">
                <i class="fas fa-check-circle text-green-500 text-6xl"></i>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Reservasi Berhasil!</h1>
            <p class="text-gray-600 mb-6">Janji temu Anda telah berhasil dibuat.</p>
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800">Kode reservasi akan dikirim melalui email/SMS ke nomor Anda.</p>
            </div>
            
            <div class="flex gap-3 justify-center">
                <a href="{{ route('pasien.riwayat') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                    <i class="fas fa-history mr-2"></i>Lihat Riwayat
                </a>
                <a href="{{ route('pasien.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                    <i class="fas fa-home mr-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection