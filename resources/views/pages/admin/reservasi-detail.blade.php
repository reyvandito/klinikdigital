@extends('layouts.admin')

@section('title', 'Detail Reservasi')
@section('page-title', 'Detail Reservasi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">Detail Reservasi / Konsultasi</h2>
        <a href="{{ route('admin.reservasi.index') }}" class="text-blue-500 hover:text-blue-700">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Informasi Pasien --}}
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
                <i class="fas fa-user text-blue-500 mr-2"></i> Informasi Pasien
            </h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-500">Nama</span>
                    <span class="font-medium">{{ $konsultasi->pasien->user->nama ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Email</span>
                    <span class="font-medium">{{ $konsultasi->pasien->user->email ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Nomor HP</span>
                    <span class="font-medium">{{ $konsultasi->pasien->user->nomor_hp ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tanggal Lahir</span>
                    <span class="font-medium">{{ $konsultasi->pasien->tanggal_lahir ? \Carbon\Carbon::parse($konsultasi->pasien->tanggal_lahir)->format('d/m/Y') : '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Jenis Kelamin</span>
                    <span class="font-medium">{{ $konsultasi->pasien->user->jenis_kelamin ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- Informasi Dokter & Jadwal --}}
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
                <i class="fas fa-user-md text-green-500 mr-2"></i> Informasi Dokter & Jadwal
            </h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-500">Dokter</span>
                    <span class="font-medium">{{ $konsultasi->dokter->user->nama ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Spesialis</span>
                    <span class="font-medium">{{ $konsultasi->dokter->spesialis ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tanggal</span>
                    <span class="font-medium">{{ $konsultasi->jadwal ? \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') : '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Jam</span>
                    <span class="font-medium">{{ $konsultasi->jadwal ? $konsultasi->jadwal->jam_mulai . ' - ' . $konsultasi->jadwal->jam_selesai : '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>
                    <span class="px-2 py-1 rounded-full text-xs
                        @if($konsultasi->status == 'menunggu') bg-yellow-100 text-yellow-700
                        @elseif($konsultasi->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                        @elseif($konsultasi->status == 'berlangsung') bg-green-100 text-green-700
                        @elseif($konsultasi->status == 'selesai') bg-gray-100 text-gray-700
                        @elseif($konsultasi->status == 'dibatalkan') bg-red-100 text-red-700
                        @endif">
                        {{ $konsultasi->status }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Keluhan --}}
    <div class="border rounded-lg p-4 mt-4">
        <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
            <i class="fas fa-comment text-orange-500 mr-2"></i> Keluhan
        </h3>
        <p class="text-gray-700">{{ $konsultasi->keluhan ?? '-' }}</p>
    </div>

    {{-- Rekam Medis (jika ada) --}}
    @if($konsultasi->rekamMedis)
    <div class="border rounded-lg p-4 mt-4 border-purple-200 bg-purple-50">
        <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
            <i class="fas fa-file-medical text-purple-500 mr-2"></i> Rekam Medis
        </h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-500">Diagnosa</span>
                <span class="font-medium">{{ $konsultasi->rekamMedis->diagnosa ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Tindakan</span>
                <span class="font-medium">{{ $konsultasi->rekamMedis->tindakan ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Resep</span>
                <span class="font-medium">{{ $konsultasi->rekamMedis->resep ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Catatan</span>
                <span class="font-medium">{{ $konsultasi->rekamMedis->catatan ?? '-' }}</span>
            </div>
        </div>
    </div>
    @else
    <div class="border rounded-lg p-4 mt-4 text-center text-gray-500 bg-gray-50">
        <i class="fas fa-file-medical text-2xl mb-2 block"></i>
        <p>Belum ada rekam medis untuk konsultasi ini.</p>
    </div>
    @endif

    {{-- Update Status Form --}}
    @if(in_array($konsultasi->status, ['menunggu', 'dikonfirmasi', 'berlangsung']))
    <div class="border rounded-lg p-4 mt-4 border-yellow-200 bg-yellow-50">
        <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
            <i class="fas fa-edit text-yellow-500 mr-2"></i> Update Status
        </h3>
        <form action="{{ route('admin.reservasi.update-status', $konsultasi->id) }}" method="POST" class="flex gap-2">
            @csrf
            @method('PUT')
            <select name="status" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <option value="menunggu" {{ $konsultasi->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="dikonfirmasi" {{ $konsultasi->status == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="berlangsung" {{ $konsultasi->status == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                <option value="selesai" {{ $konsultasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ $konsultasi->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                <i class="fas fa-save mr-1"></i> Update
            </button>
        </form>
    </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('admin.reservasi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
</div>
@endsection