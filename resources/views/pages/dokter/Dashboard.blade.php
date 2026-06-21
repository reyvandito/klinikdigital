@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="space-y-6">
    {{-- Welcome Card --}}
    <x-dokter.welcome-card :dokter="$dokter" />
    
    {{-- Stats Cards --}}
    <x-dokter.stats-card :stats="$stats" />
    
    {{-- Quick Menu --}}
    <x-dokter.quick-menu />
    
    {{-- Konsultasi Hari Ini --}}
    <x-dokter.konsultasi-hari-ini :konsultasiHariIni="$konsultasiHariIni" />
    
    {{-- Jadwal Minggu Ini --}}
    <x-dokter.jadwal-mingguan :jadwalMingguIni="$jadwalMingguIni" />
</div>
@endsection