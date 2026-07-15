@extends('layouts.home')

@section('content')
<!-- ==================== HERO SECTION ==================== -->
<div class="relative bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <pattern id="grid-dokter" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.5"/>
            </pattern>
            <rect width="100" height="100" fill="url(#grid-dokter)"/>
        </svg>
    </div>
    
    <div class="absolute top-20 left-10 w-64 h-64 bg-yellow-300 rounded-full mix-blend-overlay opacity-10 animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-400 rounded-full mix-blend-overlay opacity-10 animate-pulse"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-white/5 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 py-16 md:py-24 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-5 py-2.5 rounded-full text-white text-sm mb-6 border border-white/20">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                {{ $dokters->count() }} Dokter Tersedia
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-500">Dokter</span> Kami
            </h1>
            
            <p class="text-blue-100 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                Dokter-dokter profesional siap memberikan pelayanan terbaik untuk Anda. 
                Konsultasi mudah, cepat, dan terpercaya.
            </p>
        </div>
    </div>
    
    <div class="relative">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 40L80 45C160 50 320 60 480 55C640 50 800 30 960 25C1120 20 1280 30 1360 35L1440 40V80H0V40Z" fill="white"/>
        </svg>
    </div>
</div>

<!-- ==================== DOKTER LIST ==================== -->
<div class="container mx-auto px-4 -mt-4 relative z-10">
    {{-- Filter, Sort & Search Section --}}
    <div class="bg-white rounded-3xl shadow-xl p-4 md:p-6 mb-8 border border-gray-100">
        <div class="flex flex-col gap-4">
            {{-- Search Bar --}}
            <form action="{{ route('dokter') }}" method="GET" class="relative w-full">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari dokter berdasarkan nama atau spesialis..." 
                       class="w-full px-6 py-4 pl-14 rounded-2xl bg-gray-50 border-2 border-gray-200 text-gray-800 placeholder-gray-400 focus:border-blue-400 focus:ring-4 focus:ring-blue-400/20 transition outline-none text-base">
                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                <button type="submit" 
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition hover:shadow-lg">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('dokter', request()->except(['search', 'page'])) }}" 
                       class="absolute right-28 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition text-sm">
                        <i class="fas fa-times-circle"></i>
                    </a>
                @endif
            </form>

            {{-- Filter & Sort --}}
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    <span class="text-sm font-semibold text-gray-600 flex items-center gap-2">
                        <i class="fas fa-filter text-blue-500"></i> Filter:
                    </span>
                    
                    <a href="{{ route('dokter', request()->except(['spesialis', 'page'])) }}" 
                       class="px-4 py-2 {{ !request('spesialis') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }} rounded-xl text-sm font-semibold transition hover:scale-105">
                        Semua
                    </a>
                    
                    @php
                        $spesialisList = App\Models\Dokter::where('status', 'aktif')
                            ->select('spesialis')
                            ->distinct()
                            ->pluck('spesialis');
                    @endphp
                    
                    @foreach($spesialisList as $spesialis)
                        <a href="{{ route('dokter', array_merge(request()->except(['spesialis', 'page']), ['spesialis' => $spesialis])) }}" 
                           class="px-4 py-2 {{ request('spesialis') == $spesialis ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }} rounded-xl text-sm font-semibold transition hover:scale-105">
                            {{ ucfirst($spesialis) }}
                        </a>
                    @endforeach
                </div>

                <div class="flex items-center gap-2 text-sm text-gray-500 w-full md:w-auto">
                    <i class="fas fa-arrows-alt-v text-blue-500"></i>
                    <span>Urutkan:</span>
                    <form action="{{ route('dokter') }}" method="GET" class="flex items-center gap-2">
                        @foreach(request()->except(['sort', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="sort" 
                                onchange="this.form.submit()"
                                class="border border-gray-200 rounded-xl px-3 py-2 text-sm bg-gray-50 focus:ring-2 focus:ring-blue-400 outline-none">
                            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama Z-A</option>
                            <option value="spesialis" {{ request('sort') == 'spesialis' ? 'selected' : '' }}>Spesialis</option>
                            <option value="tarif_asc" {{ request('sort') == 'tarif_asc' ? 'selected' : '' }}>Tarif Terendah</option>
                            <option value="tarif_desc" {{ request('sort') == 'tarif_desc' ? 'selected' : '' }}>Tarif Tertinggi</option>
                        </select>
                    </form>
                </div>
            </div>

            {{-- Active Filters --}}
            @if(request('search') || request('spesialis'))
                <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-gray-100">
                    <span class="text-xs font-medium text-gray-500">Filter aktif:</span>
                    @if(request('search'))
                        <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full border border-blue-200">
                            <i class="fas fa-search"></i> "{{ request('search') }}"
                            <a href="{{ route('dokter', request()->except(['search', 'page'])) }}" class="ml-1 hover:text-blue-900">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('spesialis'))
                        <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full border border-blue-200">
                            <i class="fas fa-user-md"></i> {{ request('spesialis') }}
                            <a href="{{ route('dokter', request()->except(['spesialis', 'page'])) }}" class="ml-1 hover:text-blue-900">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        </span>
                    @endif
                    <a href="{{ route('dokter') }}" class="text-xs text-red-400 hover:text-red-600 font-medium">
                        <i class="fas fa-undo mr-1"></i> Reset semua
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Result Count --}}
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-gray-500">
            <span class="font-semibold text-gray-700">{{ $dokters->count() }}</span> dokter ditemukan
            @if(request('search'))
                untuk pencarian "<span class="font-medium text-blue-600">{{ request('search') }}</span>"
            @endif
            @if(request('spesialis'))
                dengan spesialis "<span class="font-medium text-blue-600">{{ request('spesialis') }}</span>"
            @endif
        </p>
    </div>

    {{-- Doctor Cards Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($dokters as $dokter)
        <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all hover:-translate-y-2 border border-gray-100">
            {{-- Image Container --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100" style="height: 200px;">
                @if($dokter->foto)
                    <img src="{{ asset('storage/' . $dokter->foto) }}" 
                         alt="{{ $dokter->user->nama }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                        <i class="fas fa-user-md text-6xl text-blue-400/50"></i>
                    </div>
                @endif
                
                {{-- Status Badge --}}
                <div class="absolute top-3 left-3">
                    <span class="flex items-center gap-1.5 bg-green-500/90 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-300 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                        </span>
                        {{ ucfirst($dokter->status) }}
                    </span>
                </div>
                
                {{-- Tarif Badge --}}
                <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1.5">
                    <i class="fas fa-money-bill-wave text-green-500 text-xs"></i>
                    <span class="text-sm font-bold text-gray-700">Rp {{ number_format($dokter->tarif, 0, ',', '.') }}</span>
                </div>
            </div>
            
            {{-- Content --}}
            <div class="p-5">
                <div class="flex items-start justify-between mb-1">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition">
                            {{ $dokter->user->nama }}
                        </h3>
                        <p class="text-sm text-blue-500 font-medium">{{ ucfirst($dokter->spesialis) }}</p>
                    </div>
                    <span class="bg-blue-50 text-blue-500 text-xs font-semibold px-2.5 py-1 rounded-full border border-blue-100">
                        STR: {{ $dokter->no_str }}
                    </span>
                </div>
                
                {{-- Contact Info --}}
                <div class="mt-3 space-y-1.5 text-sm text-gray-500">
                    <p class="flex items-center gap-2">
                        <i class="fas fa-phone text-blue-400 w-4"></i>
                        {{ $dokter->user->nomor_hp ?? 'Tersedia' }}
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-venus-mars text-blue-400 w-4"></i>
                        {{ $dokter->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-money-bill-wave text-blue-400 w-4"></i>
                        Rp {{ number_format($dokter->tarif, 0, ',', '.') }} / konsultasi
                    </p>
                </div>
                
                {{-- Action Button --}}
                <a href="{{ route('login') }}" 
                   class="mt-4 inline-flex items-center justify-center w-full gap-2 bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-3 rounded-2xl text-sm font-semibold transition hover:shadow-xl hover:scale-[1.02] shadow-md group/btn">
                    <i class="fas fa-calendar-plus group-hover/btn:rotate-6 transition"></i>
                    Buat Janji
                    <i class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-3xl shadow-xl p-16 text-center border border-gray-100">
            <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-user-md text-5xl text-blue-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">Tidak Ada Dokter Ditemukan</h3>
            <p class="text-gray-400 max-w-md mx-auto">
                @if(request('search') || request('spesialis'))
                    Tidak ada dokter yang sesuai dengan filter yang Anda pilih.
                @else
                    Saat ini belum ada dokter yang terdaftar. Silakan cek kembali nanti.
                @endif
            </p>
            <a href="{{ route('dokter') }}" class="inline-block mt-6 bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-8 py-3 rounded-2xl font-semibold transition hover:shadow-lg hover:scale-105">
                <i class="fas fa-undo mr-2"></i> Reset Filter
            </a>
        </div>
        @endforelse
    </div>
</div>

<style>
    .pagination {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 12px;
        background: #f3f4f6;
        color: #4b5563;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s;
        text-decoration: none;
    }
    .pagination .page-item .page-link:hover {
        background: #dbeafe;
        color: #2563eb;
    }
    .pagination .page-item.active .page-link {
        background: #2563eb;
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }
    .pagination .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    @media (max-width: 640px) {
        .pagination .page-item .page-link {
            min-width: 34px;
            height: 34px;
            font-size: 12px;
            padding: 0 8px;
        }
    }
</style>
@endsection