@extends('layouts.pasien')

@section('title', 'Feedback Terkirim')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="text-center p-8">
                {{-- Icon Success --}}
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-circle text-5xl text-green-500"></i>
                </div>

                <h1 class="text-2xl font-bold text-gray-800 mb-2">Feedback Terkirim! ✅</h1>
                <p class="text-gray-500 mb-6">Terima kasih atas keluhan dan feedback Anda. Kami akan segera menindaklanjutinya.</p>

                {{-- Informasi Tambahan --}}
                <div class="bg-blue-50 rounded-lg p-4 mb-6 text-left text-sm">
                    <p class="text-gray-700">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                        Tim kami akan merespon keluhan Anda dalam waktu 1x24 jam.
                    </p>
                </div>

                {{-- Tombol --}}
                <div class="flex flex-col gap-3">
                    <a href="{{ route('pasien.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition font-semibold">
                        <i class="fas fa-home mr-2"></i> Kembali ke Dashboard
                    </a>
                    <a href="{{ route('pasien.feedback.create') }}" class="text-blue-500 hover:text-blue-700 transition">
                        <i class="fas fa-plus mr-1"></i> Kirim Feedback Lain
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection