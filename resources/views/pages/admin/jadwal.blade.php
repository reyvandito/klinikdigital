@extends('layouts.admin')

@section('title', 'Kelola Jadwal')
@section('page-title', 'Kelola Jadwal')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
        <h2 class="text-xl font-bold text-gray-800">Daftar Jadwal Konsultasi</h2>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.jadwal.create') }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                                + Tambah Jadwal
                            </a>
                            <button onclick="location.reload()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-sync-alt mr-2"></i> Refresh
                            </button>
                        </div>        
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

                    <td class="px-4 py-3">
                        <form action="{{ route('admin.jadwal.update-status', $jadwal->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="border rounded px-2 py-1 text-sm">

                                <option value="tersedia"
                                    {{ $jadwal->status == 'tersedia' ? 'selected' : '' }}>
                                    Tersedia
                                </option>

                                <option value="penuh"
                                    {{ $jadwal->status == 'penuh' ? 'selected' : '' }}>
                                    Penuh
                                </option>

                                <option value="tutup"
                                    {{ $jadwal->status == 'tutup' ? 'selected' : '' }}>
                                    Tutup
                                </option>

                            </select>
                        </form>
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                            <div class="flex gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    Edit
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>  

                @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-calendar-times text-4xl mb-2 block"></i>
                        Belum ada data jadwal.

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