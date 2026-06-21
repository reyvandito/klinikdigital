@extends('layouts.pasien')

@section('title', 'Rekam Medis')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Rekam Medis</h1>
        <p class="text-gray-500">Riwayat kesehatan dan pengobatan Anda</p>
    </div>
    
    <x-pasien.rekam-medis-table :rekamMedis="$rekamMedis" />
</div>
@endsection