@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Dokter</h1>
            <a href="{{ route('admin.dokter.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                + Tambah Dokter
            </a>
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
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border text-left">Foto</th>
                        <th class="px-4 py-2 border text-left">ID</th>
                        <th class="px-4 py-2 border text-left">Nama</th>
                        <th class="px-4 py-2 border text-left">Email</th>
                        <th class="px-4 py-2 border text-left">Spesialis</th>
                        <th class="px-4 py-2 border text-left">No STR</th>
                        <th class="px-4 py-2 border text-left">Status</th>
                        <th class="px-4 py-2 border text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokters as $dokter)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">
                            <img src="{{ $dokter->foto_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($dokter->user->nama ?? 'Dokter') . '&background=0D8ABC&color=fff&size=40' }}" 
                                 alt="{{ $dokter->user->nama ?? 'Dokter' }}"
                                 class="w-10 h-10 rounded-full object-cover">
                        </td>
                        <td class="px-4 py-2 border">{{ $dokter->id }}</td>
                        <td class="px-4 py-2 border font-medium">{{ $dokter->user->nama ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $dokter->user->email ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $dokter->spesialis }}</td>
                        <td class="px-4 py-2 border">{{ $dokter->no_str }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 rounded text-xs {{ $dokter->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $dokter->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                            <form action="{{ route('admin.dokter.delete', $dokter->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Yakin hapus dokter {{ $dokter->user->nama ?? 'ini' }}?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500">Belum ada data dokter. Silakan tambah dokter baru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $dokters->links() }}
        </div>
    </div>
</div>
@endsection