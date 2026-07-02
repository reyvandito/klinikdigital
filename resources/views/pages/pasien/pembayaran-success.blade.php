@extends('layouts.pasien')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-md mx-auto text-center">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            {{-- Icon --}}
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check-circle text-5xl text-green-500"></i>
            </div>
            
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Pembayaran Berhasil! ✅</h1>
            <p class="text-gray-500 mb-4">Pembayaran konsultasi Anda telah dikonfirmasi.</p>
            
            {{-- Detail --}}
            <div class="bg-gray-50 rounded-xl p-4 text-left text-sm mb-6">
                <div class="flex justify-between py-1">
                    <span class="text-gray-500">Order ID</span>
                    <span class="font-medium">{{ $pembayaran->order_id }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span class="text-gray-500">Jumlah</span>
                    <span class="font-medium">{{ $pembayaran->jumlah_formatted }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span class="text-gray-500">Dibayar</span>
                    <span class="font-medium">{{ $pembayaran->paid_at ? $pembayaran->paid_at->format('d/m/Y H:i') : '-' }}</span>
                </div>
            </div>

            {{-- Info --}}
            <div class="bg-blue-50 rounded-xl p-4 text-sm text-blue-700 mb-6">
                <i class="fas fa-info-circle mr-2"></i>
                Konsultasi Anda sekarang sudah dikonfirmasi. Dokter akan segera memulai konsultasi.
            </div>

            {{-- Tombol --}}
            <a href="{{ route('pasien.riwayat.detail', $konsultasi->id) }}" 
               class="inline-block w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-semibold transition">
                <i class="fas fa-eye mr-2"></i> Lihat Detail Konsultasi
            </a>
            <a href="{{ route('pasien.dashboard') }}" 
               class="inline-block w-full mt-3 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold transition">
                <i class="fas fa-home mr-2"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection