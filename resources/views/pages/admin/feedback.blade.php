@extends('layouts.admin')

@section('title', 'Keluhan & Feedback')
@section('page-title', 'Keluhan & Feedback')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
        <h2 class="text-xl font-bold text-gray-800">
            <i class="fas fa-comment-dots text-blue-500 mr-2"></i> Daftar Keluhan & Feedback
        </h2>
        <div class="flex space-x-2">
            <button onclick="location.reload()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-sync-alt mr-2"></i> Refresh
            </button>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
            <p class="text-2xl font-bold text-red-600">{{ $totalBaru ?? 0 }}</p>
            <p class="text-sm text-red-500">Baru / Belum Dibaca</p>
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
            <p class="text-2xl font-bold text-yellow-600">{{ $totalDiproses ?? 0 }}</p>
            <p class="text-sm text-yellow-500">Sedang Diproses</p>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
            <p class="text-2xl font-bold text-green-600">{{ $totalSelesai ?? 0 }}</p>
            <p class="text-sm text-green-500">Selesai / Sudah Direspon</p>
        </div>
    </div>

    {{-- Filter --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('admin.feedback.index') }}" class="flex flex-wrap gap-2">
            <select name="status" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="dibaca" {{ request('status') == 'dibaca' ? 'selected' : '' }}>Dibaca</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            
            <select name="kategori" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kategori</option>
                <option value="umum" {{ request('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                <option value="dokter" {{ request('kategori') == 'dokter' ? 'selected' : '' }}>Dokter</option>
                <option value="website" {{ request('kategori') == 'website' ? 'selected' : '' }}>Website</option>
                <option value="reservasi" {{ request('kategori') == 'reservasi' ? 'selected' : '' }}>Reservasi</option>
                <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari nama, email, subjek..." 
                   class="flex-1 min-w-[200px] px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                <i class="fas fa-search"></i> Filter
            </button>
            
            @if(request('status') || request('kategori') || request('search'))
                <a href="{{ route('admin.feedback.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
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
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pengirim</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kategori</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Subjek</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dikirim</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($feedbacks as $index => $feedback)
                <tr class="hover:bg-gray-50 {{ $feedback->status == 'baru' ? 'bg-red-50' : '' }}">
                    <td class="px-4 py-3 text-sm">{{ $feedbacks->firstItem() + $index }}</td>
                    <td class="px-4 py-3 text-sm">
                        <div class="font-medium text-gray-800">{{ $feedback->nama }}</div>
                        <div class="text-xs text-gray-500">{{ $feedback->email }}</div>
                    </td>
                    <td class="px-4 py-3 text-sm">{!! $feedback->kategori_badge !!}</td>
                    <td class="px-4 py-3 text-sm max-w-[150px] truncate" title="{{ $feedback->subjek }}">
                        {{ Str::limit($feedback->subjek, 30) }}
                    </td>
                    <td class="px-4 py-3 text-sm">{!! $feedback->status_badge !!}</td>
                    <td class="px-4 py-3 text-sm">{{ $feedback->created_at->diffForHumans() }}</td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.feedback.show', $feedback->id) }}" 
                               class="text-blue-500 hover:text-blue-700" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" 
                                  method="POST" class="inline" 
                                  onsubmit="return confirm('Hapus feedback ini?')">
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
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 block"></i>
                        Belum ada keluhan atau feedback.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $feedbacks->links() }}
    </div>
</div>
@endsection