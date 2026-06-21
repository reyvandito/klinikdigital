@extends('layouts.dokter')

@section('title', 'Rekam Medis')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Rekam Medis</h1>
        <p class="text-gray-500">Kelola rekam medis pasien</p>
    </div>
    
    {{-- Search Form --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('dokter.rekam-medis.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari nama pasien..." 
                   class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('dokter.rekam-medis.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </form>
    </div>
    
    <x-dokter.rekam-medis-table :rekamMedis="$rekamMedis" />
</div>
@endsection