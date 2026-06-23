@extends('layouts.admin')

@section('title', 'Kelola Jadwal')
@section('page-title', 'Kelola Jadwal')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
        <h2 class="text-xl font-bold text-gray-800">Daftar Jadwal Konsultasi</h2>
       
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
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dokter</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Spesialis</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kuota</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Sisa</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($jadwals as $index => $jadwal)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $jadwals->firstItem() + $index }}</td>
                    <td class="px-4 py-3 text-sm font-medium">
                        {{ $jadwal->dokter->user->nama ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $jadwal->dokter->spesialis ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $jadwal->kuota }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $jadwal->sisa_kuota }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($jadwal->status == 'tersedia') bg-green-100 text-green-700
                            @elseif($jadwal->status == 'penuh') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700
                            @endif">
                            {{ $jadwal->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex space-x-2">
                          
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-calendar-times text-4xl mb-2 block"></i>
                        Belum ada data jadwal.
                        <div class="mt-2">
                            <a href="{{ route('admin.jadwal.create') }}" class="text-blue-500 hover:underline text-sm">
                                Tambah jadwal pertama →
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $jadwals->links() }}
    </div>
</div>
@endsection