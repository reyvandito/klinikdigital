<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <a href="{{ route('admin.dokter.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md p-6 hover:shadow-lg transition-all hover:scale-105 transform">
        <div class="flex items-center justify-between text-white">
            <div>
                <i class="fas fa-user-md text-4xl mb-2"></i>
                <h3 class="text-xl font-bold">Kelola Dokter</h3>
                <p class="text-sm opacity-90">Tambah, edit, hapus dokter</p>
            </div>
            <i class="fas fa-arrow-right text-2xl"></i>
        </div>
    </a>
    
    <a href="{{ route('admin.pasien.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md p-6 hover:shadow-lg transition-all hover:scale-105 transform">
        <div class="flex items-center justify-between text-white">
            <div>
                <i class="fas fa-users text-4xl mb-2"></i>
                <h3 class="text-xl font-bold">Kelola Pasien</h3>
                <p class="text-sm opacity-90">Tambah, edit, hapus pasien</p>
            </div>
            <i class="fas fa-arrow-right text-2xl"></i>
        </div>
    </a>
    
    <a href="{{ route('admin.jadwal.index') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-md p-6 hover:shadow-lg transition-all hover:scale-105 transform">
        <div class="flex items-center justify-between text-white">
            <div>
                <i class="fas fa-calendar-alt text-4xl mb-2"></i>
                <h3 class="text-xl font-bold">Kelola Jadwal</h3>
                <p class="text-sm opacity-90">Lihat & kelola jadwal</p>
            </div>
            <i class="fas fa-arrow-right text-2xl"></i>
        </div>
    </a>
</div>

