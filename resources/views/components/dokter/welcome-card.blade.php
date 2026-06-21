<div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            {{-- Foto Dokter --}}
            <div class="flex-shrink-0">
                @if($dokter->foto && file_exists(public_path('storage/' . $dokter->foto)))
                    <img src="{{ asset('storage/' . $dokter->foto) }}" 
                         alt="{{ $dokter->user->nama }}" 
                         class="w-20 h-20 md:w-24 md:h-24 rounded-full object-cover border-4 border-white/30 shadow-lg">
                @else
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-white/20 flex items-center justify-center border-4 border-white/30 shadow-lg">
                        <i class="fas fa-user-md text-3xl md:text-4xl text-white/80"></i>
                    </div>
                @endif
            </div>
            
            <div>
                <h1 class="text-2xl font-bold mb-1">Selamat Datang, {{ $dokter->user->nama }}! 👋</h1>
                <p class="text-blue-100">Kelola jadwal praktik dan pasien Anda dengan mudah.</p>
                <div class="mt-2 flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-white/20 rounded-full text-sm">
                        <i class="fas fa-stethoscope mr-1"></i> {{ $dokter->spesialis }}
                    </span>
                    <span class="px-3 py-1 bg-white/20 rounded-full text-sm">
                        <i class="fas fa-id-card mr-1"></i> STR: {{ $dokter->no_str }}
                    </span>
                </div>
            </div>
        </div>
        <div class="hidden lg:block">
            <i class="fas fa-user-md text-6xl text-white opacity-30"></i>
        </div>
    </div>
</div>