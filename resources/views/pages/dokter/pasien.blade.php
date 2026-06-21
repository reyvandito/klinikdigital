@extends('layouts.dokter')

@section('title', 'Daftar Pasien Konsultasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Daftar Pasien</h1>
        <p class="text-gray-500">Pasien yang akan/ sedang konsultasi dengan Anda</p>
    </div>

    {{-- Search Form --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('dokter.pasien.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari nama pasien..." 
                   class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('dokter.pasien.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama Pasien</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Keluhan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal Konsultasi</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jam</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($konsultasis as $index => $konsultasi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm font-medium">
                            {{ $konsultasi->pasien->user->nama ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ Str::limit($konsultasi->keluhan, 50) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $konsultasi->jadwal->jam_mulai ?? '-' }} - {{ $konsultasi->jadwal->jam_selesai ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($konsultasi->status == 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($konsultasi->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                                @elseif($konsultasi->status == 'berlangsung') bg-green-100 text-green-700
                                @elseif($konsultasi->status == 'selesai') bg-gray-100 text-gray-700
                                @else bg-red-100 text-red-700
                                @endif">
                                {{ $konsultasi->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('dokter.pasien.detail', $konsultasi->pasien_id) }}" 
                                   class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                @if($konsultasi->status == 'menunggu' || $konsultasi->status == 'dikonfirmasi')
                                <form action="{{ route('dokter.konsultasi.mulai', $konsultasi->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:text-green-700">
                                        <i class="fas fa-play"></i> Mulai
                                    </button>
                                </form>
                                @endif
                                @if($konsultasi->status == 'berlangsung')
                                <a href="{{ route('dokter.rekam-medis.create', ['konsultasi_id' => $konsultasi->id]) }}" 
                                   class="text-purple-500 hover:text-purple-700">
                                    <i class="fas fa-file-medical"></i> Rekam Medis
                                </a>
                                <form action="{{ route('dokter.konsultasi.selesai', $konsultasi->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-check"></i> Selesai
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2 block"></i>
                            Belum ada pasien yang konsultasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $konsultasis->links() }}
    </div>
</div>
@endsection