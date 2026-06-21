@extends('layouts.dokter')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Rekam Medis</h1>
        <a href="{{ route('dokter.rekam-medis.index') }}"
           class="text-blue-600 hover:text-blue-800 flex items-center gap-1 text-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow p-6 space-y-5">
        <!-- Info Pasien & Kunjungan -->
        <div class="border-b pb-4">
            <h2 class="font-semibold text-gray-700 mb-3">Informasi Kunjungan</h2>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <p class="text-gray-500">Pasien</p>
                    <p class="font-medium">{{ $rekamMedis->konsultasi->pasien->user->nama }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tanggal</p>
                    <p>{{ \Carbon\Carbon::parse($rekamMedis->konsultasi->jadwal->tanggal)->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Jam</p>
                    <p>{{ $rekamMedis->konsultasi->jadwal->jam_mulai }} - {{ $rekamMedis->konsultasi->jadwal->jam_selesai }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Keluhan</p>
                    <p>{{ $rekamMedis->konsultasi->keluhan }}</p>
                </div>
            </div>
        </div>

        <!-- Rekam Medis -->
        <div class="space-y-4 text-sm">
            <div class="bg-blue-50 rounded-lg p-4">
                <p class="text-blue-600 font-medium mb-1">Diagnosa</p>
                <p>{{ $rekamMedis->diagnosa }}</p>
            </div>

            @if($rekamMedis->tindakan)
            <div class="bg-purple-50 rounded-lg p-4">
                <p class="text-purple-600 font-medium mb-1">Tindakan Medis</p>
                <p>{{ $rekamMedis->tindakan }}</p>
            </div>
            @endif

            @if($rekamMedis->resep)
            <div class="bg-green-50 rounded-lg p-4">
                <p class="text-green-600 font-medium mb-1">Resep Obat</p>
                <p class="whitespace-pre-line">{{ $rekamMedis->resep }}</p>
            </div>
            @endif

            @if($rekamMedis->catatan)
            <div class="bg-yellow-50 rounded-lg p-4">
                <p class="text-yellow-600 font-medium mb-1">Catatan</p>
                <p>{{ $rekamMedis->catatan }}</p>
            </div>
            @endif
        </div>

        <!-- Aksi -->
        <div class="border-t pt-4 flex gap-3">
            <a href="{{ route('dokter.rekam-medis.edit', ['id' => $rekamMedis->id]) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <form method="POST" action="{{ route('dokter.rekam-medis.delete', $rekamMedis->id) }}"
                  onsubmit="return confirm('Hapus rekam medis ini?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    <i class="fas fa-trash mr-1"></i> Hapus
                </button>
            </form>
        </div>

        <p class="text-xs text-gray-400">Direkam: {{ $rekamMedis->created_at->format('d M Y H:i') }}</p>
    </div>
</div>
@endsection