@extends('layouts.dokter')

@section('title', 'Riwayat Konsultasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Konsultasi</h1>
        <p class="text-gray-500">Daftar konsultasi yang telah selesai</p>
    </div>

    {{-- Search --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('dokter.konsultasi.riwayat') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari nama pasien..." 
                   class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('dokter.konsultasi.riwayat') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pasien</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jam</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Keluhan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Diagnosa</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($konsultasis as $index => $konsultasi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $konsultasis->firstItem() + $index }}</td>
                        <td class="px-4 py-3 text-sm font-medium">
                            {{ $konsultasi->pasien->user->nama ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $konsultasi->jadwal ? \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $konsultasi->jadwal ? $konsultasi->jadwal->jam_mulai . ' - ' . $konsultasi->jadwal->jam_selesai : '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm max-w-[150px] truncate" title="{{ $konsultasi->keluhan }}">
                            {{ Str::limit($konsultasi->keluhan, 30) }}
                        </td>
                        <td class="px-4 py-3 text-sm max-w-[150px] truncate" title="{{ $konsultasi->rekamMedis->diagnosa ?? '' }}">
                            {{ $konsultasi->rekamMedis ? Str::limit($konsultasi->rekamMedis->diagnosa, 20) : '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                @if($konsultasi->status == 'selesai') bg-green-100 text-green-700 
                                @elseif($konsultasi->status == 'dibatalkan') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ $konsultasi->status }}
                            </span>
                            @if($konsultasi->rekamMedis)
                                <span class="ml-1 px-1 py-0.5 bg-purple-100 text-purple-700 rounded text-xs">
                                    <i class="fas fa-file-medical"></i>
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('dokter.konsultasi.detail', $konsultasi->id) }}" 
                               class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2 block"></i>
                            Belum ada riwayat konsultasi.
                            <div class="mt-2 text-sm">
                                Konsultasi yang sudah selesai akan muncul di sini.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t">
            {{ $konsultasis->links() }}
        </div>
    </div>
</div>
@endsection