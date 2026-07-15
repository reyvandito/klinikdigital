@extends('layouts.home')

@section('title', 'Klinik Digital - Layanan Kesehatan Modern')

@section('content')
{{-- HERO SECTION with Parallax Effect --}}
<div class="relative bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <pattern id="grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.5"/>
            </pattern>
            <rect width="100" height="100" fill="url(#grid)"/>
        </svg>
    </div>
    
    {{-- Floating Shapes --}}
    <div class="absolute top-20 left-10 w-64 h-64 bg-yellow-300 rounded-full mix-blend-overlay opacity-10 animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-400 rounded-full mix-blend-overlay opacity-10 animate-pulse"></div>
    
    <div class="container mx-auto px-4 py-16 md:py-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {{-- Left Content --}}
            <div>
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white text-sm mb-6 border border-white/20">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    Layanan Kesehatan 24/7
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4">
                    Kesehatan Anda
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-500 block">Prioritas Kami</span>
                </h1>
                
                <p class="text-blue-100 text-lg md:text-xl max-w-lg mb-8 leading-relaxed">
                    Layanan kesehatan modern dengan dokter profesional yang siap membantu Anda kapan saja. Konsultasi mudah, cepat, dan terpercaya.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('login') }}" 
                       class="group bg-white text-blue-600 hover:bg-blue-50 px-8 py-4 rounded-2xl font-semibold transition-all shadow-xl hover:shadow-2xl flex items-center gap-3 text-lg">
                        <i class="fas fa-calendar-check"></i>
                        Buat Janji
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ route('dokter') }}" 
                       class="group bg-transparent border-2 border-white/80 text-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-2xl font-semibold transition-all flex items-center gap-3 text-lg">
                        <i class="fas fa-user-md"></i>
                        Lihat Dokter
                    </a>
                </div>
                
                <div class="flex items-center gap-8 mt-8">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-white flex items-center justify-center text-blue-600 font-bold text-sm">A</div>
                        <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-white flex items-center justify-center text-blue-600 font-bold text-sm">S</div>
                        <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-white flex items-center justify-center text-blue-600 font-bold text-sm">B</div>
                        <div class="w-10 h-10 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center text-white font-bold text-sm">+</div>
                    </div>
                    <div>
                        <p class="text-white font-bold text-xl">{{ App\Models\Pasien::count() }}+</p>
                        <p class="text-blue-200 text-sm">Pasien Terdaftar</p>
                    </div>
                </div>
            </div>
            
            {{-- Right Image --}}
            <div class="relative flex justify-center lg:justify-end">
                <div class="relative w-full max-w-md">
                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-gradient-to-r from-yellow-300 to-yellow-500 rounded-full opacity-20 blur-2xl"></div>
                    <div class="absolute -bottom-6 -right-6 w-40 h-40 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full opacity-20 blur-2xl"></div>
                    
                    <img src="data:image/jpeg;base64,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" 
                         alt="Dokter" 
                         class="rounded-3xl shadow-2xl w-full h-auto object-cover relative z-10 border-4 border-white/20"
                         loading="lazy">
                    
                    {{-- Floating Card 1 --}}
                    <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-2xl px-5 py-4 z-20 animate-bounce-slow">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white text-xl">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">100% Terpercaya</p>
                                <p class="text-xs text-gray-500">Dokter Profesional</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Floating Card 2 --}}
                    <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-2xl px-5 py-4 z-20 animate-bounce-slow animation-delay-200">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">QRIS Payment</p>
                                <p class="text-xs text-gray-500">Bayar Mudah & Cepat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Wave Divider --}}
    <div class="relative">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 40L80 45C160 50 320 60 480 55C640 50 800 30 960 25C1120 20 1280 30 1360 35L1440 40V80H0V40Z" fill="white"/>
        </svg>
    </div>
</div>

<div class="container mx-auto px-4 -mt-4 relative z-10">
    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 text-center hover:shadow-2xl transition-all hover:-translate-y-1 border border-gray-100">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-user-md text-xl text-blue-500"></i>
            </div>
            <p class="text-2xl md:text-3xl font-bold text-blue-600">{{ App\Models\Dokter::where('status', 'aktif')->count() }}</p>
            <p class="text-gray-500 text-sm">Dokter Aktif</p>
        </div>
        <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 text-center hover:shadow-2xl transition-all hover:-translate-y-1 border border-gray-100">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-users text-xl text-green-500"></i>
            </div>
            <p class="text-2xl md:text-3xl font-bold text-green-600">{{ App\Models\Pasien::count() }}</p>
            <p class="text-gray-500 text-sm">Total Pasien</p>
        </div>
        <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 text-center hover:shadow-2xl transition-all hover:-translate-y-1 border border-gray-100">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-file-medical text-xl text-purple-500"></i>
            </div>
            <p class="text-2xl md:text-3xl font-bold text-purple-600">{{ App\Models\Konsultasi::where('status', 'selesai')->count() }}</p>
            <p class="text-gray-500 text-sm">Konsultasi Selesai</p>
        </div>
        <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 text-center hover:shadow-2xl transition-all hover:-translate-y-1 border border-gray-100">
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-star text-xl text-yellow-500"></i>
            </div>
            <p class="text-2xl md:text-3xl font-bold text-yellow-600">4.8</p>
            <p class="text-gray-500 text-sm">Rating Pasien</p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mt-8 md:mt-12">
        <a href="{{ route('login') }}" 
           class="group bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-2xl p-6 md:p-8 text-center text-white transition-all hover:shadow-2xl hover:scale-105 shadow-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <i class="fas fa-calendar-plus text-3xl md:text-4xl mb-3 block relative z-10"></i>
            <span class="font-semibold text-xl md:text-2xl block relative z-10">Buat Janji</span>
            <p class="text-blue-100 text-sm md:text-base relative z-10">Konsultasi dengan dokter</p>
            <div class="mt-3 text-blue-200 group-hover:translate-x-2 transition-transform relative z-10">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>
        <a href="{{ route('dokter') }}" 
           class="group bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-2xl p-6 md:p-8 text-center text-white transition-all hover:shadow-2xl hover:scale-105 shadow-lg relative overflow-hidden">
            <div class="absolute top-0 left-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-white/5 rounded-full translate-y-1/2 translate-x-1/2"></div>
            <i class="fas fa-user-md text-3xl md:text-4xl mb-3 block relative z-10"></i>
            <span class="font-semibold text-xl md:text-2xl block relative z-10">Lihat Dokter</span>
            <p class="text-blue-100 text-sm md:text-base relative z-10">Daftar dokter spesialis</p>
            <div class="mt-3 text-blue-200 group-hover:translate-x-2 transition-transform relative z-10">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>
        <a href="{{ route('register') }}" 
           class="group bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-2xl p-6 md:p-8 text-center text-white transition-all hover:shadow-2xl hover:scale-105 shadow-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <i class="fas fa-user-plus text-3xl md:text-4xl mb-3 block relative z-10"></i>
            <span class="font-semibold text-xl md:text-2xl block relative z-10">Daftar</span>
            <p class="text-blue-100 text-sm md:text-base relative z-10">Buat akun pasien</p>
            <div class="mt-3 text-blue-200 group-hover:translate-x-2 transition-transform relative z-10">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>
    </div>

    {{-- Steps Section --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden mt-8 md:mt-12 border border-gray-100">
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 md:px-8 py-5 border-b">
            <h2 class="text-xl md:text-2xl font-bold text-blue-700 flex items-center gap-3">
                <span class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                    <i class="fas fa-shoe-prints"></i>
                </span>
                Mudahnya Konsultasi di Klinik Digital
            </h2>
        </div>
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center group">
                    <div class="relative w-16 h-16 mx-auto mb-3">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto text-white text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform group-hover:shadow-xl">
                            1
                        </div>
                        <div class="hidden md:block absolute -right-6 top-1/2 -translate-y-1/2 w-8 h-0.5 bg-blue-200 group-hover:bg-blue-400 transition-colors"></div>
                    </div>
                    <h3 class="font-semibold text-gray-800">Daftar Akun</h3>
                    <p class="text-xs text-gray-500">Registrasi sebagai pasien</p>
                </div>
                <div class="text-center group">
                    <div class="relative w-16 h-16 mx-auto mb-3">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto text-white text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform group-hover:shadow-xl">
                            2
                        </div>
                        <div class="hidden md:block absolute -right-6 top-1/2 -translate-y-1/2 w-8 h-0.5 bg-blue-200 group-hover:bg-blue-400 transition-colors"></div>
                    </div>
                    <h3 class="font-semibold text-gray-800">Booking Jadwal</h3>
                    <p class="text-xs text-gray-500">Pilih dokter & jadwal</p>
                </div>
                <div class="text-center group">
                    <div class="relative w-16 h-16 mx-auto mb-3">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto text-white text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform group-hover:shadow-xl">
                            3
                        </div>
                        <div class="hidden md:block absolute -right-6 top-1/2 -translate-y-1/2 w-8 h-0.5 bg-blue-200 group-hover:bg-blue-400 transition-colors"></div>
                    </div>
                    <h3 class="font-semibold text-gray-800">Konsultasi</h3>
                    <p class="text-xs text-gray-500">Konsultasi dengan dokter</p>
                </div>
                <div class="text-center group">
                    <div class="relative w-16 h-16 mx-auto mb-3">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto text-white text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform group-hover:shadow-xl">
                            4
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-800">Bayar & Rekam Medis</h3>
                    <p class="text-xs text-gray-500">Bayar & dapatkan rekam medis</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Services Section --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden mt-8 md:mt-12 border border-gray-100">
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 md:px-8 py-5 border-b">
            <h2 class="text-xl md:text-2xl font-bold text-blue-700 flex items-center gap-3">
                <span class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white">
                    <i class="fas fa-star"></i>
                </span>
                Layanan Unggulan Kami
            </h2>
        </div>
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 text-center hover:shadow-xl transition-all hover:-translate-y-1 border border-blue-100 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-lg">
                        <i class="fas fa-stethoscope text-2xl text-white"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-lg">Konsultasi Dokter</h3>
                    <p class="text-sm text-gray-500 mt-1">Konsultasi langsung dengan dokter spesialis terpercaya</p>
                    
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 text-center hover:shadow-xl transition-all hover:-translate-y-1 border border-blue-100 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-lg">
                        <i class="fas fa-credit-card text-2xl text-white"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-lg">Bayar Pakai QRIS</h3>
                    <p class="text-sm text-gray-500 mt-1">Pembayaran mudah, cepat, dan aman dengan QRIS</p>
                    
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 text-center hover:shadow-xl transition-all hover:-translate-y-1 border border-blue-100 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-lg">
                        <i class="fas fa-file-medical text-2xl text-white"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-lg">Rekam Medis Digital</h3>
                    <p class="text-sm text-gray-500 mt-1">Riwayat kesehatan tersimpan aman dan bisa diakses kapan saja</p>
                   
                </div>
            </div>
        </div>
    </div>

    {{-- Doctors Section --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden mt-8 md:mt-12 border border-gray-100">
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 md:px-8 py-5 border-b">
            <h2 class="text-xl md:text-2xl font-bold text-blue-700 flex items-center gap-3">
                <span class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                    <i class="fas fa-user-md"></i>
                </span>
                Dokter Spesialis Kami
            </h2>
        </div>
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $dokters = App\Models\Dokter::with('user')->where('status', 'aktif')->take(3)->get();
                @endphp
                @forelse($dokters as $dokter)
                <div class="bg-white rounded-2xl p-6 text-center hover:shadow-2xl transition-all hover:-translate-y-2 border border-gray-100 group">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <img src="{{ $dokter->foto_url }}" alt="{{ $dokter->user->nama }}" 
                             class="w-24 h-24 rounded-full object-cover border-4 border-blue-100 group-hover:border-blue-500 transition-all mx-auto">
                       
                    </div>
                    <h3 class="font-semibold text-gray-800 text-lg">{{ $dokter->user->nama }}</h3>
                    <p class="text-sm text-blue-500 font-medium">{{ $dokter->spesialis }}</p>
                    <div class="flex items-center justify-center gap-1 mt-2 text-yellow-400">
                        
                    </div>
                    <a href="{{ route('login') }}" 
                       class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-xl text-sm transition-all hover:shadow-lg">
                        Buat Janji
                    </a>
                </div>
                @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    <i class="fas fa-user-md text-5xl mb-4 block text-gray-300"></i>
                    <p>Belum ada data dokter</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('dokter') }}" class="group inline-flex items-center gap-2 text-blue-500 hover:text-blue-600 font-semibold text-lg transition-all hover:gap-3">
                    Lihat Semua Dokter
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Tips Section --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden mt-8 md:mt-12 border border-gray-100">
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 md:px-8 py-5 border-b">
            <h2 class="text-xl md:text-2xl font-bold text-blue-700 flex items-center gap-3">
                <span class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white">
                    <i class="fas fa-lightbulb"></i>
                </span>
                Tips Kesehatan
            </h2>
        </div>
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-blue-50 transition-all group cursor-default">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fas fa-hand-holding-heart text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-lg">Jaga Pola Makan</p>
                        <p class="text-sm text-gray-500">Konsumsi makanan bergizi seimbang setiap hari</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-blue-50 transition-all group cursor-default">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fas fa-bed text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-lg">Istirahat Cukup</p>
                        <p class="text-sm text-gray-500">Tidur 7-8 jam per hari untuk kesehatan optimal</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-blue-50 transition-all group cursor-default">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fas fa-running text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-lg">Olahraga Teratur</p>
                        <p class="text-sm text-gray-500">Minimal 30 menit setiap hari untuk tubuh sehat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection