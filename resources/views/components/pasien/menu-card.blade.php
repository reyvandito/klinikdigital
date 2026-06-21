<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <a href="{{ route('pasien.reservasi.create') }}" 
       class="bg-blue-500 hover:bg-blue-600 rounded-xl p-4 text-center text-white transition transform hover:scale-105">
        <i class="fas fa-calendar-plus text-2xl mb-2 block"></i>
        <span class="font-semibold">Buat Janji</span>
        <p class="text-xs text-blue-100 mt-1">Konsultasi dengan dokter</p>
    </a>
    <a href="{{ route('pasien.riwayat') }}" 
       class="bg-blue-500 hover:bg-blue-600 rounded-xl p-4 text-center text-white transition transform hover:scale-105">
        <i class="fas fa-history text-2xl mb-2 block"></i>
        <span class="font-semibold">Riwayat</span>
        <p class="text-xs text-blue-100 mt-1">Lihat riwayat konsultasi</p>
    </a>
    <a href="{{ route('pasien.rekam-medis') }}" 
       class="bg-blue-500 hover:bg-blue-600 rounded-xl p-4 text-center text-white transition transform hover:scale-105">
        <i class="fas fa-file-medical text-2xl mb-2 block"></i>
        <span class="font-semibold">Rekam Medis</span>
        <p class="text-xs text-blue-100 mt-1">Riwayat kesehatan Anda</p>
    </a>
    <a href="{{ route('pasien.feedback.create') }}" 
       class="bg-blue-500 hover:bg-blue-600 rounded-xl p-4 text-center text-white transition transform hover:scale-105">
        <i class="fas fa-comment-dots text-2xl mb-2 block"></i>
        <span class="font-semibold">Keluhan</span>
        <p class="text-xs text-blue-100 mt-1">Sampaikan keluhan Anda</p>
    </a>
</div>