@extends('layouts.dokter')

@section('title', 'Konsultasi Selesai')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-8 text-center">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-circle text-5xl text-white"></i>
                </div>
                <h1 class="text-2xl font-bold text-white">Konsultasi Selesai! ✅</h1>
                <p class="text-green-100 mt-1">Konsultasi telah berhasil diselesaikan</p>
            </div>

            {{-- Body --}}
            <div class="p-6">
                {{-- Informasi Konsultasi --}}
                <div class="border-b pb-4 mb-4">
                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i> Informasi Konsultasi
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-gray-500">Pasien</p>
                            <p class="font-semibold">{{ $konsultasi->pasien->user->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Dokter</p>
                            <p class="font-semibold">{{ $konsultasi->dokter->user->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Tanggal</p>
                            <p>{{ \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Jam</p>
                            <p>{{ $konsultasi->jadwal->jam_mulai }} - {{ $konsultasi->jadwal->jam_selesai }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-500">Keluhan</p>
                            <p class="bg-gray-50 p-2 rounded">{{ $konsultasi->keluhan }}</p>
                        </div>
                    </div>
                </div>

                {{-- Rekam Medis --}}
                @if($konsultasi->rekamMedis)
                <div class="border-b pb-4 mb-4">
                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-file-medical text-purple-500 mr-2"></i> Rekam Medis
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-500">Diagnosa</p>
                            <p class="font-medium">{{ $konsultasi->rekamMedis->diagnosa }}</p>
                        </div>
                        @if($konsultasi->rekamMedis->tindakan)
                        <div>
                            <p class="text-gray-500">Tindakan</p>
                            <p>{{ $konsultasi->rekamMedis->tindakan }}</p>
                        </div>
                        @endif
                        @if($konsultasi->rekamMedis->resep)
                        <div>
                            <p class="text-gray-500">Resep</p>
                            <p class="whitespace-pre-line">{{ $konsultasi->rekamMedis->resep }}</p>
                        </div>
                        @endif
                        @if($konsultasi->rekamMedis->catatan)
                        <div>
                            <p class="text-gray-500">Catatan</p>
                            <p>{{ $konsultasi->rekamMedis->catatan }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center mb-4">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl mb-2 block"></i>
                    <p class="text-yellow-700">Belum ada rekam medis untuk konsultasi ini.</p>
                    <a href="{{ route('dokter.rekam-medis.create', ['konsultasi_id' => $konsultasi->id]) }}" 
                       class="inline-block mt-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition">
                        <i class="fas fa-plus mr-1"></i> Isi Rekam Medis Sekarang
                    </a>
                </div>
                @endif

                {{-- Tombol Aksi --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('dokter.konsultasi.detail', $konsultasi->id) }}" 
                       class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg transition font-semibold">
                        <i class="fas fa-eye mr-2"></i> Lihat Detail Konsultasi
                    </a>
                    <a href="{{ route('dokter.konsultasi.riwayat') }}" 
                       class="flex-1 text-center bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-lg transition font-semibold">
                        <i class="fas fa-history mr-2"></i> Lihat Riwayat
                    </a>
                    <a href="{{ route('dokter.dashboard') }}" 
                       class="flex-1 text-center bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg transition font-semibold">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection