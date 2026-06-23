<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            {{-- Logo --}}
           <a href="{{ route('pasien.dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition">
    <img src="{{ asset('images/logoklinik.png') }}" alt="Klinik Digital" class="h-10 w-auto">
    <span class="font-bold text-xl text-gray-800">Klinik Digital</span>
</a>

            {{-- Menu Tengah (Desktop) --}}
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('pasien.dashboard') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('pasien.dashboard') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-home mr-1"></i> Dashboard
                </a>
                <a href="{{ route('pasien.reservasi.create') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('pasien.reservasi.create') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-calendar-plus mr-1"></i> Buat Janji
                </a>
                <a href="{{ route('pasien.riwayat') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('pasien.riwayat*') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-history mr-1"></i> Riwayat
                </a>
                <a href="{{ route('pasien.rekam-medis') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('pasien.rekam-medis*') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-file-medical mr-1"></i> Rekam Medis
                </a>
                <a href="{{ route('pasien.feedback.create') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('pasien.feedback*') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-comment-dots mr-1"></i> Keluhan
                </a>
            </div>

            {{-- Right Section --}}
            <div class="flex items-center space-x-4">
                {{-- Profile Dropdown --}}
                <div class="relative group" style="padding-bottom: 10px; margin-bottom: -10px;">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition px-3 py-2 rounded-lg hover:bg-blue-50">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->nama ?? 'P', 0, 1)) }}
                        </div>
                        <span class="font-medium hidden md:block">{{ Auth::user()->nama ?? 'Pasien' }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="absolute right-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 hidden group-hover:block z-50 overflow-hidden" 
                         style="padding-top: 8px; margin-top: -2px;">
                        <a href="{{ route('pasien.profile') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 transition">
                            <i class="fas fa-user-circle w-5 text-blue-500"></i>
                            <span class="ml-3">Profil</span>
                        </a>
                        <a href="{{ route('pasien.feedback.history') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 transition">
                            <i class="fas fa-list w-5 text-blue-500"></i>
                            <span class="ml-3">Riwayat Keluhan</span>
                        </a>
                        <hr class="my-1">
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 hover:bg-red-50 transition">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span class="ml-3">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>