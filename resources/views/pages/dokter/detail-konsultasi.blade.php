@extends('layouts.dokter')

@section('title', 'Detail Konsultasi')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Konsultasi</h1>
        <a href="{{ route('dokter.konsultasi.riwayat') }}"
           class="text-blue-600 hover:text-blue-800 flex items-center gap-1 text-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        {{-- Header Status --}}
        <div class="px-6 py-4 border-b {{ $konsultasi->status == 'selesai' ? 'bg-green-50' : ($konsultasi->status == 'dibatalkan' ? 'bg-red-50' : 'bg-blue-50') }}">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500">Status Konsultasi</span>
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

        {{-- Body --}}
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Informasi Pasien --}}
                <div>
                    <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3 flex items-center">
                        <i class="fas fa-user text-blue-500 mr-2"></i> Informasi Pasien
                    </h3>
                    <div class="space-y-2 text-sm">
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
                            <span class="text-gray-500">Usia</span>
                            <span class="font-medium">{{ $konsultasi->pasien->usia ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Informasi Konsultasi --}}
                <div>
                    <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3 flex items-center">
                        <i class="fas fa-calendar-alt text-green-500 mr-2"></i> Informasi Konsultasi
                    </h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tanggal</span>
                            <span class="font-medium">{{ $konsultasi->jadwal ? \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') : '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jam</span>
                            <span class="font-medium">{{ $konsultasi->jadwal ? $konsultasi->jadwal->jam_mulai . ' - ' . $konsultasi->jadwal->jam_selesai : '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dokter</span>
                            <span class="font-medium">{{ $konsultasi->dokter->user->nama ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Spesialis</span>
                            <span class="font-medium">{{ $konsultasi->dokter->spesialis ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dibuat</span>
                            <span class="font-medium">{{ $konsultasi->created_at ? $konsultasi->created_at->format('d/m/Y H:i') : '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Keluhan --}}
            <div class="mt-5 border-t pt-4">
                <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3 flex items-center">
                    <i class="fas fa-comment-medical text-yellow-500 mr-2"></i> Keluhan Pasien
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700">{{ $konsultasi->keluhan ?? '-' }}</p>
                </div>
            </div>

            {{-- Rekam Medis --}}
            @if($konsultasi->rekamMedis)
            <div class="mt-5 border-t pt-4">
                <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3 flex items-center">
                    <i class="fas fa-file-medical text-purple-500 mr-2"></i> Rekam Medis
                </h3>
                <div class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-blue-50 rounded-lg p-3">
                            <p class="text-sm text-blue-600 font-medium">Diagnosa</p>
                            <p class="text-gray-800">{{ $konsultasi->rekamMedis->diagnosa ?? '-' }}</p>
                        </div>
                        @if($konsultasi->rekamMedis->tindakan)
                        <div class="bg-purple-50 rounded-lg p-3">
                            <p class="text-sm text-purple-600 font-medium">Tindakan</p>
                            <p class="text-gray-800">{{ $konsultasi->rekamMedis->tindakan }}</p>
                        </div>
                        @endif
                        @if($konsultasi->rekamMedis->resep)
                        <div class="bg-green-50 rounded-lg p-3 col-span-1 md:col-span-2">
                            <p class="text-sm text-green-600 font-medium">Resep Obat</p>
                            <p class="text-gray-800 whitespace-pre-line">{{ $konsultasi->rekamMedis->resep }}</p>
                        </div>
                        @endif
                        @if($konsultasi->rekamMedis->catatan)
                        <div class="bg-yellow-50 rounded-lg p-3 col-span-1 md:col-span-2">
                            <p class="text-sm text-yellow-600 font-medium">Catatan Dokter</p>
                            <p class="text-gray-800">{{ $konsultasi->rekamMedis->catatan }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="flex gap-3 mt-3">
                        <a href="{{ route('dokter.rekam-medis.show', $konsultasi->rekamMedis->id) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg transition">
                            <i class="fas fa-eye mr-1"></i> Detail Rekam Medis
                        </a>
                        <a href="{{ route('dokter.rekam-medis.edit', ['id' => $konsultasi->rekamMedis->id]) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded-lg transition">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="mt-5 border-t pt-4">
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <i class="fas fa-file-medical text-4xl text-gray-300 mb-2 block"></i>
                    <p class="text-gray-500">Belum ada rekam medis untuk konsultasi ini.</p>
                    <a href="{{ route('dokter.rekam-medis.create', ['konsultasi_id' => $konsultasi->id]) }}"
                       class="inline-block mt-3 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition">
                        <i class="fas fa-plus mr-1"></i> Isi Rekam Medis
                    </a>
                </div>
            </div>
            @endif

            {{-- Tombol Aksi --}}
            @if(in_array($konsultasi->status, ['menunggu', 'dikonfirmasi']))
            <div class="mt-5 border-t pt-4 flex gap-3">
                <form action="{{ route('dokter.konsultasi.mulai', $konsultasi->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">
                        <i class="fas fa-play mr-1"></i> Mulai Konsultasi
                    </button>
                </form>
            </div>
            @endif

            @if($konsultasi->status == 'berlangsung')
            <div class="mt-5 border-t pt-4 flex gap-3">
                <form action="{{ route('dokter.konsultasi.selesai', $konsultasi->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition" onclick="return confirm('Selesaikan konsultasi ini?')">
                        <i class="fas fa-check mr-1"></i> Selesaikan Konsultasi
                    </button>
                </form>
                <a href="{{ route('dokter.rekam-medis.create', ['konsultasi_id' => $konsultasi->id]) }}"
                   class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-file-medical mr-1"></i> Isi Rekam Medis
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection