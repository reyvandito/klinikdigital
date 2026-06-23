@extends('layouts.dokter')

@section('title', 'Detail Pasien')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="{{ route('dokter.pasien.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-600 mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pasien
        </a>
        
        <!-- Card Detail Pasien -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Detail Pasien</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="font-semibold text-gray-800">{{ $pasien->user->nama ?? '-' }}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Usia</p>
                        <p class="font-semibold text-gray-800">{{ $pasien->usia ?? '-' }}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p class="font-semibold text-gray-800">{{ $pasien->jenis_kelamin_formatted ?? '-' }}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Nomor HP</p>
                        <p class="font-semibold text-gray-800">{{ $pasien->user->nomor_hp ?? '-' }}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-semibold text-gray-800">{{ $pasien->user->email ?? '-' }}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="font-semibold text-gray-800">{{ $pasien->alamat ?? '-' }}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Total Konsultasi</p>
                        <p class="font-semibold text-gray-800">{{ $pasien->konsultasi->count() ?? 0 }}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Tanggal Lahir</p>
                        <p class="font-semibold text-gray-800">{{ $pasien->tanggal_lahir ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d/m/Y') : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Riwayat Konsultasi -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">Riwayat Konsultasi</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dokter</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Keluhan</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Diagnosa</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($pasien->konsultasi as $index => $konsultasi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm">
                                {{ $konsultasi->jadwal ? \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium">
                                {{ $konsultasi->dokter->user->nama ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm max-w-[150px] truncate" title="{{ $konsultasi->keluhan }}">
                                {{ Str::limit($konsultasi->keluhan, 30) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $konsultasi->rekamMedis ? Str::limit($konsultasi->rekamMedis->diagnosa, 20) : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs
                                    @if($konsultasi->status == 'menunggu') bg-yellow-100 text-yellow-700
                                    @elseif($konsultasi->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                                    @elseif($konsultasi->status == 'berlangsung') bg-green-100 text-green-700
                                    @elseif($konsultasi->status == 'selesai') bg-gray-100 text-gray-700
                                    @elseif($konsultasi->status == 'dibatalkan') bg-red-100 text-red-700
                                    @endif">
                                    {{ $konsultasi->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('dokter.konsultasi.detail', $konsultasi->id) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2 block"></i>
                                Belum ada riwayat konsultasi
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Form Catatan -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">Tambah Catatan</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('dokter.pasien.catatan', $pasien->id) }}" method="POST">
                    @csrf
                    <textarea name="catatan" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis catatan untuk pasien..."></textarea>
                    <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-save mr-2"></i> Simpan Catatan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection