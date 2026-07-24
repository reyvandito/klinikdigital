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
                    
                    <img src="data:image/jpeg;https://media.licdn.com/dms/image/v2/D5603AQF5SXnUHE6TDQ/profile-displayphoto-scale_200_200/B56Z8CxT50IQAc-/0/1782457910573?e=2147483647&v=beta&t=LXUaqIpI66701SNWhVEcF81EOmB1sNy0xRvEd3pMIjc
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