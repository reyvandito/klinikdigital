<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="{{ route('dokter.dashboard') }}" class="text-2xl font-bold text-blue-600">
                <i class="fas fa-clinic-medical mr-2"></i>Klinik Digital
            </a>
            
            <!-- Menu Desktop -->
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('dokter.dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                <a href="{{ route('dokter.rekam-medis.index') }}" class="text-gray-700 hover:text-blue-600 transition">
                    <i class="fas fa-file-medical mr-1"></i> Rekam Medis
                </a>
                <a href="{{ route('dokter.pasien.index') }}" class="text-gray-700 hover:text-blue-600 transition">Pasien</a>
                <a href="{{ route('dokter.profile') }}" class="text-gray-700 hover:text-blue-600 transition">Profile</a>
            </div>
            
            <!-- User Menu -->
            <div class="flex items-center space-x-4">
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-user-md text-2xl"></i>
                        <span>Dokter</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl hidden group-hover:block">
                        <a href="{{ route('dokter.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="{{ route('dokter.rekam-medis.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">
                            <i class="fas fa-file-medical mr-2"></i> Rekam Medis
                        </a>
                        <hr class="my-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>