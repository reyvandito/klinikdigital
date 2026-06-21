@extends('layouts.pasien')

@section('title', 'Riwayat Reservasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Reservasi</h1>
        <p class="text-gray-500">Daftar semua janji temu yang telah Anda buat</p>
    </div>
    
    {{-- Filter Status --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('pasien.riwayat') }}" class="flex flex-wrap gap-2">
            <select name="status" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                <i class="fas fa-filter"></i> Filter
            </button>
            @if(request('status'))
                <a href="{{ route('pasien.riwayat') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </form>
    </div>
    
    {{-- Riwayat Table --}}
    <x-pasien.riwayat-table :konsultasis="$konsultasis" />
    
    <div class="mt-6 text-center">
        <a href="{{ route('pasien.reservasi.create') }}" class="inline-flex items-center text-blue-500 hover:text-blue-600">
            <i class="fas fa-plus-circle mr-2"></i> Buat Janji Baru
        </a>
    </div>
</div>
@endsection