@extends('layouts.pasien')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Rekam Medis</h1>
        <a href="{{ route('pasien.rekam-medis') }}"
           class="text-blue-600 hover:text-blue-800 flex items-center gap-1 text-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow p-6 space-y-5">
        <!-- Info Konsultasi -->
        <div class="border-b pb-4">
            <h2 class="font-semibold text-gray-700 mb-3">Informasi Kunjungan</h2>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <p class="text-gray-500">Dokter</p>
                    <p class="font-medium">{{ $rekamMedis->konsultasi->dokter->user->nama }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Spesialisasi</p>
                    <p>{{ $rekamMedis->konsultasi->dokter->spesialis }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tanggal Kunjungan</p>
                    <p>{{ \Carbon\Carbon::parse($rekamMedis->konsultasi->jadwal->tanggal)->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Jam</p>
                    <p>{{ $rekamMedis->konsultasi->jadwal->jam_mulai }} - {{ $rekamMedis->konsultasi->jadwal->jam_selesai }}</p>
                </div>
            </div>
        </div>

        <!-- Rekam Medis -->
        <div>
            <h2 class="font-semibold text-gray-700 mb-3">Hasil Pemeriksaan</h2>
            <div class="space-y-4 text-sm">
                <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-blue-600 font-medium mb-1">Diagnosa</p>
                    <p class="text-gray-800">{{ $rekamMedis->diagnosa }}</p>
                </div>

                @if($rekamMedis->tindakan)
                <div class="bg-purple-50 rounded-lg p-4">
                    <p class="text-purple-600 font-medium mb-1">Tindakan Medis</p>
                    <p class="text-gray-800">{{ $rekamMedis->tindakan }}</p>
                </div>
                @endif

                @if($rekamMedis->resep)
                <div class="bg-green-50 rounded-lg p-4">
                    <p class="text-green-600 font-medium mb-1">Resep Obat</p>
                    <p class="text-gray-800 whitespace-pre-line">{{ $rekamMedis->resep }}</p>
                </div>
                @endif

                @if($rekamMedis->catatan)
                <div class="bg-yellow-50 rounded-lg p-4">
                    <p class="text-yellow-600 font-medium mb-1">Catatan Dokter</p>
                    <p class="text-gray-800">{{ $rekamMedis->catatan }}</p>
                </div>
                @endif
            </div>
        </div>

        <p class="text-xs text-gray-400 text-right">
            Direkam pada: {{ $rekamMedis->created_at->format('d M Y H:i') }}
        </p>
    </div>
</div>
@endsection