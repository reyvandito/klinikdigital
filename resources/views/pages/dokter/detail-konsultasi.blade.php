@extends('layouts.dokter')

@section('title', 'Detail Konsultasi')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Konsultasi</h1>
        <a href="{{ route('dokter.konsultasi.riwayat') }}"
           class="text-blue-600 hover:text-blue-800 flex items-center gap-1 text-sm">
            <i class="fas fa-arrow-left"></i> Riwayat
        </a>
    </div>

    <div class="bg-white rounded-xl shadow p-6 space-y-5">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500">Nama Pasien</p>
                <p class="font-semibold">{{ $konsultasi->pasien->user->nama }}</p>
            </div>
            <div>
                <p class="text-gray-500">Tanggal</p>
                <p>{{ \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-gray-500">Jam</p>
                <p>{{ $konsultasi->jadwal->jam_mulai }} - {{ $konsultasi->jadwal->jam_selesai }}</p>
            </div>
            <div>
                <p class="text-gray-500">Status</p>
                <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    {{ ucfirst($konsultasi->status) }}
                </span>
            </div>
            <div class="col-span-2">
                <p class="text-gray-500">Keluhan Pasien</p>
                <p class="bg-gray-50 rounded-lg p-3 mt-1">{{ $konsultasi->keluhan }}</p>
            </div>
        </div>

        @if($konsultasi->rekamMedis)
        <div class="border-t pt-4">
            <h3 class="font-semibold text-gray-700 mb-3">Rekam Medis</h3>
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
            <div class="mt-4 flex gap-3">
                <a href="{{ route('dokter.rekam-medis.show', $konsultasi->rekamMedis->id) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg transition">
                    Lihat Detail
                </a>
                <a href="{{ route('dokter.rekam-medis.edit', ['id' => $konsultasi->rekamMedis->id]) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded-lg transition">
                    Edit Rekam Medis
                </a>
            </div>
        </div>
        @else
        <div class="border-t pt-4">
            <a href="{{ route('dokter.rekam-medis.create', ['konsultasi_id' => $konsultasi->id]) }}"
               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition">
                <i class="fas fa-plus mr-1"></i> Isi Rekam Medis
            </a>
        </div>
        @endif
    </div>
</div>
@endsectionv