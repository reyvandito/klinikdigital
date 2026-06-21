@extends('layouts.pasien')

@section('title', 'Buat Janji Temu')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="inline-block p-4 bg-blue-50 rounded-full mb-4">
                <i class="fas fa-calendar-plus text-4xl text-blue-500"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Buat Janji Temu</h1>
            <p class="text-gray-500 text-lg">Pilih dokter dan isi keluhan Anda</p>
        </div>

        {{-- Step Progress --}}
        <div class="flex items-center justify-center mb-10">
            <div class="flex items-center space-x-2 md:space-x-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold">1</div>
                    <span class="ml-2 text-sm font-medium text-blue-600 hidden sm:inline">Pilih Dokter</span>
                </div>
                <div class="w-12 h-0.5 bg-blue-300"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">2</div>
                    <span class="ml-2 text-sm font-medium text-gray-500 hidden sm:inline">Pilih Jadwal</span>
                </div>
                <div class="w-12 h-0.5 bg-gray-300"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                    <span class="ml-2 text-sm font-medium text-gray-500 hidden sm:inline">Isi Keluhan</span>
                </div>
            </div>
        </div>

        {{-- Form Reservasi dengan Pilihan Dokter --}}
        <x-pasien.form-reservasi :dokters="$dokters" />
        
        {{-- Informasi Pendukung --}}
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
                <h3 class="font-semibold text-blue-800 mb-3 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-500"></i> Informasi Penting
                </h3>
                <ul class="text-sm text-blue-700 space-y-2">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                        <span>Konsultasi dilakukan secara online via video call</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                        <span>Konfirmasi janji akan dikirim via WhatsApp/Email</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                        <span>Batalkan janji maksimal H-1 sebelum jadwal</span>
                    </li>
                </ul>
            </div>
            <div class="bg-purple-50 rounded-xl p-5 border border-purple-100">
                <h3 class="font-semibold text-purple-800 mb-3 flex items-center">
                    <i class="fas fa-clock mr-2 text-purple-500"></i> Jam Praktik
                </h3>
                <ul class="text-sm text-purple-700 space-y-2">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-clock text-purple-500 mt-0.5"></i>
                        <span>Senin - Jumat: 08:00 - 17:00</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-clock text-purple-500 mt-0.5"></i>
                        <span>Sabtu: 08:00 - 14:00</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-clock text-purple-500 mt-0.5"></i>
                        <span>Minggu: Tutup</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-6 text-center">
            <a href="{{ route('pasien.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection