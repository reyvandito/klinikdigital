<div class="bg-blue-600 rounded-xl shadow-lg p-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->nama ?? Auth::user()->email ?? 'Pasien' }}! 👋</h1>
            <p class="text-blue-100">Kelola janji temu dan riwayat kesehatan Anda dengan mudah.</p>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-user-injured text-6xl text-white opacity-50"></i>
        </div>
    </div>
</div>