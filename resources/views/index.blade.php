@extends('layouts.home')

@section('title', 'Klinik Digital - Layanan Kesehatan Modern')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    {{-- Welcome Card (Sama seperti pasien) --}}
    <div class="bg-blue-600 rounded-xl shadow-lg p-6 text-white mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Selamat Datang di Klinik Digital! 👋</h1>
                <p class="text-blue-100">Layanan kesehatan modern dengan dokter profesional siap membantu Anda 24/7. Konsultasi mudah, cepat, dan terpercaya.</p>
                <div class="mt-3 flex gap-2">
                    <span class="px-3 py-1 bg-white/20 rounded-full text-sm">
                        <i class="fas fa-calendar-alt mr-1"></i> Janji Temu Online
                    </span>
                    <span class="px-3 py-1 bg-white/20 rounded-full text-sm">
                        <i class="fas fa-user-md mr-1"></i> Dokter Profesional
                    </span>
                </div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-hospital-user text-6xl text-white opacity-50"></i>
            </div>
        </div>
    </div>

    {{-- Stats Cards (Sama seperti pasien) --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
            <p class="text-gray-500 text-sm">Total Dokter</p>
            <p class="text-2xl font-bold text-blue-600">{{ App\Models\Dokter::where('status', 'aktif')->count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
            <p class="text-gray-500 text-sm">Total Pasien</p>
            <p class="text-2xl font-bold text-blue-600">{{ App\Models\Pasien::count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
            <p class="text-gray-500 text-sm">Konsultasi Selesai</p>
            <p class="text-2xl font-bold text-blue-600">{{ App\Models\Konsultasi::count() }}</p>
        </div>
    </div>

    {{-- Menu Card (Sama seperti pasien) --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('login') }}" 
           class="bg-blue-500 hover:bg-blue-600 rounded-xl p-4 text-center text-white transition transform hover:scale-105">
            <i class="fas fa-calendar-plus text-2xl mb-2 block"></i>
            <span class="font-semibold">Buat Janji</span>
            <p class="text-xs text-blue-100 mt-1">Konsultasi dengan dokter</p>
        </a>
        <a href="{{ route('dokter') }}" 
           class="bg-blue-500 hover:bg-blue-600 rounded-xl p-4 text-center text-white transition transform hover:scale-105">
            <i class="fas fa-user-md text-2xl mb-2 block"></i>
            <span class="font-semibold">Lihat Dokter</span>
            <p class="text-xs text-blue-100 mt-1">Daftar dokter spesialis</p>
        </a>
        <a href="{{ route('login') }}" 
           class="bg-blue-500 hover:bg-blue-600 rounded-xl p-4 text-center text-white transition transform hover:scale-105">
            <i class="fas fa-file-medical text-2xl mb-2 block"></i>
            <span class="font-semibold">Rekam Medis</span>
            <p class="text-xs text-blue-100 mt-1">Riwayat kesehatan Anda</p>
        </a>
        <a href="{{ route('register') }}" 
           class="bg-blue-500 hover:bg-blue-600 rounded-xl p-4 text-center text-white transition transform hover:scale-105">
            <i class="fas fa-user-plus text-2xl mb-2 block"></i>
            <span class="font-semibold">Daftar</span>
            <p class="text-xs text-blue-100 mt-1">Buat akun pasien</p>
        </a>
    </div>

    {{-- Janji Temu Mendatang (Sama seperti pasien) --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b bg-blue-50">
            <h2 class="text-lg font-semibold text-blue-700">
                <i class="fas fa-calendar-check mr-2 text-blue-500"></i> Janji Temu Mendatang
            </h2>
        </div>
        <div class="p-4">
            @php
                $janjiTemu = App\Models\Konsultasi::with(['pasien.user', 'dokter.user', 'jadwal'])
                    ->whereDate('created_at', '>=', today())
                    ->take(3)
                    ->get();
            @endphp
            @forelse($janjiTemu as $janji)
            <div class="border-b last:border-0 pb-3 mb-3 last:pb-0">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $janji->pasien->user->nama ?? '-' }}</p>
                        <p class="text-sm text-gray-500">Dokter: {{ $janji->dokter->user->nama ?? '-' }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs text-gray-500">
                                <i class="fas fa-calendar-alt mr-1"></i> 
                                {{ $janji->jadwal ? \Carbon\Carbon::parse($janji->jadwal->tanggal)->format('d/m/Y') : '-' }}
                            </span>
                            <span class="text-xs text-gray-500">
                                <i class="fas fa-clock mr-1"></i> 
                                {{ $janji->jadwal->jam_mulai ?? '-' }} - {{ $janji->jadwal->jam_selesai ?? '-' }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($janji->status == 'menunggu') bg-yellow-100 text-yellow-700
                            @elseif($janji->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                            @elseif($janji->status == 'berlangsung') bg-green-100 text-green-700
                            @else bg-gray-100 text-gray-700
                            @endif">
                            {{ $janji->status }}
                        </span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mt-1">Keluhan: {{ Str::limit($janji->keluhan, 50) }}</p>
            </div>
            @empty
            <div class="text-center py-6 text-gray-500">
                <i class="fas fa-calendar-times text-4xl mb-2 block"></i>
                <p>Belum ada janji temu</p>
                <a href="{{ route('login') }}" class="text-blue-500 text-sm mt-2 inline-block">Login untuk buat janji →</a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Rekomendasi Dokter (Sama seperti pasien) --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b bg-blue-50">
            <h2 class="text-lg font-semibold text-blue-700">
                <i class="fas fa-star mr-2 text-yellow-500"></i> Rekomendasi Dokter
            </h2>
        </div>
        <div class="p-4 space-y-3">
            @php
                $dokters = App\Models\Dokter::with('user')->where('status', 'aktif')->take(3)->get();
            @endphp
            @forelse($dokters as $dokter)
            <div class="flex items-center justify-between border-b last:border-0 pb-3 mb-3 last:pb-0">
                <div class="flex items-center gap-3">
                    <img src="{{ $dokter->foto_url }}" alt="{{ $dokter->user->nama }}" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $dokter->user->nama }}</p>
                        <p class="text-sm text-gray-500">{{ $dokter->spesialis }}</p>
                    </div>
                </div>
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                    <i class="fas fa-calendar-plus mr-1"></i> Buat Janji
                </a>
            </div>
            @empty
            <div class="text-center py-6 text-gray-500">
                <i class="fas fa-user-md text-4xl mb-2 block"></i>
                <p>Belum ada data dokter</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Tips Kesehatan (Sama seperti pasien) --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b bg-blue-50">
            <h2 class="text-lg font-semibold text-blue-700">
                <i class="fas fa-lightbulb mr-2 text-blue-500"></i> Tips Kesehatan
            </h2>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-blue-50 transition">
                    <i class="fas fa-hand-holding-heart text-2xl text-blue-500"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Jaga Pola Makan</p>
                        <p class="text-xs text-gray-500">Konsumsi makanan bergizi seimbang</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-blue-50 transition">
                    <i class="fas fa-bed text-2xl text-blue-500"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Istirahat Cukup</p>
                        <p class="text-xs text-gray-500">Tidur 7-8 jam per hari</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-blue-50 transition">
                    <i class="fas fa-running text-2xl text-blue-500"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Olahraga Teratur</p>
                        <p class="text-xs text-gray-500">Minimal 30 menit setiap hari</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Riwayat Terbaru (Sama seperti pasien) --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b bg-blue-50 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-blue-700">
                <i class="fas fa-history mr-2 text-blue-500"></i> Aktivitas Terbaru
            </h2>
            <a href="{{ route('login') }}" class="text-blue-600 text-sm hover:underline">Login untuk melihat semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Pasien</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Dokter</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @php
                        $aktivitas = App\Models\Konsultasi::with(['pasien.user', 'dokter.user', 'jadwal'])
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp
                    @forelse($aktivitas as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm">
                            {{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-4 py-2 text-sm font-medium">
                            {{ $item->pasien->user->nama ?? '-' }}
                        </td>
                        <td class="px-4 py-2 text-sm">
                            {{ $item->dokter->user->nama ?? '-' }}
                        </td>
                        <td class="px-4 py-2 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs
                                @if($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($item->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                                @elseif($item->status == 'berlangsung') bg-green-100 text-green-700
                                @elseif($item->status == 'selesai') bg-gray-100 text-gray-700
                                @else bg-red-100 text-red-700
                                @endif">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2 block"></i>
                            Belum ada aktivitas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection