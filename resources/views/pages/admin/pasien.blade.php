@extends('layouts.admin')

@section('title', 'Manajemen Pasien')
@section('page-title', 'Manajemen Pasien')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
        <h2 class="text-xl font-bold text-gray-800">Daftar Pasien</h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.pasien.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-plus mr-2"></i> Tambah Pasien
            </a>
            <button onclick="location.reload()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-sync-alt mr-2"></i> Refresh
            </button>
        </div>
    </div>

    {{-- Search Form --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('admin.pasien.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari nama atau email pasien..." 
                   class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.pasien.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
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

    <div class="overflow-x-auto">
        <table class="w-full min-w-[800px]">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No. HP</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal Lahir</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jenis Kelamin</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Total Konsultasi</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($pasiens as $index => $pasien)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $pasiens->firstItem() + $index }}</td>
                    <td class="px-4 py-3 text-sm font-medium">{{ $pasien->user->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $pasien->user->email ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $pasien->user->nomor_hp ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $pasien->tanggal_lahir ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                    <td class="px-4 py-3 text-sm">
                        @if($pasien->user && $pasien->user->jenis_kelamin)
                            <span class="px-2 py-1 rounded-full text-xs {{ $pasien->user->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                {{ $pasien->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                            {{ $pasien->konsultasi->count() ?? 0 }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pasien.delete', $pasien->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus pasien {{ $pasien->user->nama ?? 'ini' }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-users text-4xl mb-2 block"></i>
                        Belum ada data pasien.
                        <div class="mt-2">
                            <a href="{{ route('admin.pasien.create') }}" class="text-blue-500 hover:underline">Tambah pasien pertama →</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $pasiens->links() }}
    </div>
</div>
@endsection