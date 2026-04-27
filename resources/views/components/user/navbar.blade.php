<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-2">
                <i class="fas fa-hospital-user text-2xl text-blue-500"></i>
                <span class="font-bold text-xl">Klinik Digital</span>
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-gray-700">Welcome, {{ request()->routeIs('dashboard.dokter') ? 'Dokter' : 'Pasien' }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>