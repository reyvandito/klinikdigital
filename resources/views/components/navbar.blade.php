<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-blue-500 hover:text-blue-600 transition-colors">
                <i class="fas fa-hospital-user text-2xl"></i>
                <span class="font-bold text-xl">Klinik Digital</span>
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