@extends('layouts.pasien')

@section('title', 'Detail Riwayat Reservasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Reservasi</h1>
            <a href="{{ route('pasien.riwayat') }}" class="text-blue-500 hover:text-blue-700">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            {{-- Header Status --}}
            <div class="px-6 py-4 border-b {{ $konsultasi->status == 'selesai' ? 'bg-green-50' : ($konsultasi->status == 'dibatalkan' ? 'bg-red-50' : 'bg-blue-50') }}">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">Status</span>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
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

            {{-- Content --}}
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Informasi Dokter --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
                            <i class="fas fa-user-md text-blue-500 mr-2"></i> Informasi Dokter
                        </h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Nama</span>
                                <span class="font-medium">{{ $konsultasi->dokter->user->nama ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Spesialis</span>
                                <span class="font-medium">{{ $konsultasi->dokter->spesialis ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Jadwal --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
                            <i class="fas fa-calendar-alt text-green-500 mr-2"></i> Informasi Jadwal
                        </h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Tanggal</span>
                                <span class="font-medium">{{ $konsultasi->jadwal ? \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') : '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Jam</span>
                                <span class="font-medium">{{ $konsultasi->jadwal ? $konsultasi->jadwal->jam_mulai . ' - ' . $konsultasi->jadwal->jam_selesai : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keluhan --}}
                <div class="mt-6">
                    <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
                        <i class="fas fa-comment text-yellow-500 mr-2"></i> Keluhan
                    </h3>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $konsultasi->keluhan ?? '-' }}</p>
                </div>

                {{-- Rekam Medis (jika ada) --}}
                @if($konsultasi->rekamMedis)
                <div class="mt-6 border-t pt-4">
                    <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
                        <i class="fas fa-file-medical text-purple-500 mr-2"></i> Rekam Medis
                    </h3>
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <span class="text-sm text-gray-500">Diagnosa</span>
                            <p class="font-medium">{{ $konsultasi->rekamMedis->diagnosa ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Tindakan</span>
                            <p class="font-medium">{{ $konsultasi->rekamMedis->tindakan ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Resep</span>
                            <p class="font-medium">{{ $konsultasi->rekamMedis->resep ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Catatan</span>
                            <p class="font-medium">{{ $konsultasi->rekamMedis->catatan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="mt-6 border-t pt-4 text-center text-gray-500">
                    <i class="fas fa-file-medical text-2xl mb-2 block"></i>
                    <p>Belum ada rekam medis untuk konsultasi ini.</p>
                </div>
                @endif

                {{-- Tombol Aksi --}}
                @if(in_array($konsultasi->status, ['menunggu', 'dikonfirmasi']))
                <div class="mt-6 border-t pt-4 flex justify-end">
                    <a href="{{ route('pasien.reservasi.batal', $konsultasi->id) }}" 
                       class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg"
                       onclick="return confirm('Yakin ingin membatalkan reservasi ini?')">
                        <i class="fas fa-times mr-1"></i> Batalkan Reservasi
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection