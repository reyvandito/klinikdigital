@extends('layouts.admin')

@section('title', 'Manajemen Reservasi')
@section('page-title', 'Manajemen Reservasi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
        <h2 class="text-xl font-bold text-gray-800">Daftar Reservasi / Konsultasi</h2>
        <div class="flex space-x-2">
            <button onclick="location.reload()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-sync-alt mr-2"></i> Refresh
            </button>
        </div>
    </div>

    {{-- Filter Status --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('admin.reservasi.index') }}" class="flex flex-wrap gap-2">
            <select name="status" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari nama pasien..." 
                   class="flex-1 min-w-[200px] px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                <i class="fas fa-search"></i> Filter
            </button>
            
            @if(request('status') || request('search'))
                <a href="{{ route('admin.reservasi.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full min-w-[800px]">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pasien</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dokter</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Keluhan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dibuat</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($konsultasis as $index => $konsultasi)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $konsultasis->firstItem() + $index }}</td>
                    <td class="px-4 py-3 text-sm font-medium">
                        <span class="text-gray-800">{{ $konsultasi->pasien->user->nama ?? '-' }}</span>
                        <br>
                        <span class="text-xs text-gray-500">{{ $konsultasi->pasien->user->email ?? '' }}</span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <span class="font-medium">{{ $konsultasi->dokter->user->nama ?? '-' }}</span>
                        <br>
                        <span class="text-xs text-gray-500">{{ $konsultasi->dokter->spesialis ?? '' }}</span>
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
                    <td class="px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($konsultasi->status == 'menunggu') bg-yellow-100 text-yellow-700
                            @elseif($konsultasi->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                            @elseif($konsultasi->status == 'berlangsung') bg-green-100 text-green-700
                            @elseif($konsultasi->status == 'selesai') bg-gray-100 text-gray-700
                            @elseif($konsultasi->status == 'dibatalkan') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700
                            @endif">
                            {{ $konsultasi->status }}
                        </span>
                        @if($konsultasi->rekamMedis)
                            <span class="ml-1 px-1 py-0.5 bg-purple-100 text-purple-700 rounded text-xs">
                                <i class="fas fa-file-medical"></i>
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ \Carbon\Carbon::parse($konsultasi->created_at)->diffForHumans() }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.reservasi.detail', $konsultasi->id) }}" 
                               class="text-blue-500 hover:text-blue-700" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(in_array($konsultasi->status, ['menunggu', 'dikonfirmasi']))
                            <form action="{{ route('admin.reservasi.update-status', $konsultasi->id) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" 
                                        class="text-xs border rounded px-1 py-0.5 focus:outline-none">
                                    <option value="">Ubah Status</option>
                                    <option value="dikonfirmasi">Konfirmasi</option>
                                    <option value="berlangsung">Mulai</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Batalkan</option>
                                </select>
                            </form>
                            @endif
                            <form action="{{ route('admin.reservasi.delete', $konsultasi->id) }}" 
                                  method="POST" class="inline" 
                                  onsubmit="return confirm('Hapus reservasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-calendar-times text-4xl mb-2 block"></i>
                        Belum ada data reservasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $konsultasis->links() }}
    </div>
</div>
@endsection