<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <a href="{{ route('dokter.pasien.index') }}" 
       class="bg-blue-500 hover:bg-blue-600 rounded-xl p-5 text-center text-white transition transform hover:scale-105">
        <i class="fas fa-users text-3xl mb-2 block"></i>
        <span class="font-semibold text-lg">Daftar Pasien</span>
        <p class="text-xs text-blue-100 mt-1">Lihat pasien yang konsultasi</p>
    </a>
    <a href="{{ route('dokter.jadwal.index') }}" 
       class="bg-blue-500 hover:bg-blue-600 rounded-xl p-5 text-center text-white transition transform hover:scale-105">
        <i class="fas fa-calendar-alt text-3xl mb-2 block"></i>
        <span class="font-semibold text-lg">Kelola Jadwal</span>
        <p class="text-xs text-yellow-100 mt-1">Atur jadwal praktik</p>
    </a>
    <a href="{{ route('dokter.rekam-medis.index') }}" 
       class="bg-blue-500 hover:bg-blue-600 rounded-xl p-5 text-center text-white transition transform hover:scale-105">
        <i class="fas fa-file-medical text-3xl mb-2 block"></i>
        <span class="font-semibold text-lg">Rekam Medis</span>
        <p class="text-xs text-green-100 mt-1">Lihat riwayat rekam medis</p>
    </a>
    <a href="{{ route('dokter.rekam-medis.create') }}" 
       class="bg-blue-500 hover:bg-blue-600 rounded-xl p-5 text-center text-white transition transform hover:scale-105">
        <i class="fas fa-plus-circle text-3xl mb-2 block"></i>
        <span class="font-semibold text-lg">Buat Rekam Medis</span>
        <p class="text-xs text-purple-100 mt-1">Tambah rekam medis baru</p>
    </a>
</div>