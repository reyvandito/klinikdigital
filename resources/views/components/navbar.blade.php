<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-2 hover:opacity-80 transition">
                <img src="{{ asset('images/logoklinik.png') }}" alt="Klinik Digital" class="h-10 w-auto">
                <span class="font-bold text-xl text-gray-800">Klinik Digital</span>
            </a>

            <!-- Desktop Menu -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-500 transition-colors {{ request()->routeIs('home') ? 'text-blue-500 font-semibold' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('dokter') }}" class="text-gray-700 hover:text-blue-500 transition-colors {{ request()->routeIs('dokter') ? 'text-blue-500 font-semibold' : '' }}">
                    Dokter
                </a>
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>