@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->nama ?? 'Admin' }}!</h1>
            <p class="text-blue-100">Kelola sistem dengan mudah melalui dashboard ini.</p>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-chart-line text-6xl text-white opacity-50"></i>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<x-admin.stats-card :stats="$stats" />

<!-- Menu Cepat -->
<x-admin.menu-card />


<!-- Aktivitas & Jadwal -->
<x-admin.aktivitas-jadwal :konsultasiTerbaru="$konsultasiTerbaru" />
@endsection