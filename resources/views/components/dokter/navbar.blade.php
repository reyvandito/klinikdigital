<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            {{-- Logo --}}
            <a href="{{ route('dokter.dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition">
    <img src="{{ asset('images/logoklinik.png') }}" alt="Klinik Digital" class="h-10 w-auto">
    <span class="font-bold text-xl text-gray-800">Klinik Digital</span>
    <span class="hidden md:inline text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Dokter</span>
</a>

            {{-- Menu Tengah (Desktop) --}}
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('dokter.dashboard') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('dokter.dashboard') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-home mr-1"></i> Dashboard
                </a>
                <a href="{{ route('dokter.pasien.index') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('dokter.pasien*') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-users mr-1"></i> Pasien
                </a>
                <a href="{{ route('dokter.jadwal.index') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('dokter.jadwal*') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-calendar-alt mr-1"></i> Jadwal
                </a>
                <a href="{{ route('dokter.rekam-medis.index') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('dokter.rekam-medis*') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-file-medical mr-1"></i> Rekam Medis
                </a>
                <a href="{{ route('dokter.feedback.index') }}" class="text-gray-600 hover:text-blue-600 transition font-medium {{ request()->routeIs('dokter.feedback*') ? 'text-blue-600' : '' }}">
                    <i class="fas fa-comment-dots mr-1"></i> Feedback
                </a>
            </div>

            {{-- Right Section --}}
            <div class="flex items-center space-x-4">
                {{-- Profile Dropdown --}}
                <div class="relative group" style="padding-bottom: 10px; margin-bottom: -10px;">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition px-3 py-2 rounded-lg hover:bg-blue-50">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-sm overflow-hidden">
                            @php
                                $dokter = App\Models\Dokter::where('user_id', Auth::id())->first();
                            @endphp
                            @if($dokter && $dokter->foto && file_exists(public_path('storage/' . $dokter->foto)))
                                <img src="{{ asset('storage/' . $dokter->foto) }}" alt="{{ Auth::user()->nama }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(Auth::user()->nama ?? 'D', 0, 1)) }}
                            @endif
                        </div>
                        <span class="font-medium hidden md:block">{{ Auth::user()->nama ?? 'Dokter' }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="absolute right-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 hidden group-hover:block z-50 overflow-hidden" 
                         style="padding-top: 8px; margin-top: -2px;">
                        <a href="{{ route('dokter.profile') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 transition">
                            <i class="fas fa-user-circle w-5 text-blue-500"></i>
                            <span class="ml-3">Profil</span>
                        </a>
                        <a href="{{ route('dokter.jadwal.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 transition">
                            <i class="fas fa-calendar-alt w-5 text-blue-500"></i>
                            <span class="ml-3">Kelola Jadwal</span>
                        </a>
                        <a href="{{ route('dokter.rekam-medis.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 transition">
                            <i class="fas fa-file-medical w-5 text-blue-500"></i>
                            <span class="ml-3">Rekam Medis</span>
                        </a>
                        <a href="{{ route('dokter.feedback.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 transition">
                            <i class="fas fa-comment-dots w-5 text-blue-500"></i>
                            <span class="ml-3">Feedback Pasien</span>
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