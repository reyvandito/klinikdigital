@extends('layouts.pasien')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <x-pasien.welcome-card />
    <x-pasien.stats-card :stats="$stats" />
    <x-pasien.menu-card />
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <x-pasien.janji-temu-card :janjiTemu="$janjiTemu" />
        <x-pasien.rekomendasi-dokter :dokters="$dokters ?? []" />
    </div>
    
    <x-pasien.riwayat-card :riwayatTerbaru="$riwayatTerbaru" />
    <x-pasien.tips-card />
</div>
@endsection