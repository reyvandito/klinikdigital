@extends('layouts.home')

@section('title', 'Klinik Digital - Layanan Kesehatan Modern')

@section('content')
<!-- ==================== HERO SECTION ==================== -->
<div class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="container mx-auto px-4 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                    Kesehatan Anda <br>
                    <span class="text-yellow-300">Prioritas Kami</span>
                </h1>
                <p class="text-lg text-blue-100 mb-8">Layanan kesehatan modern dengan dokter profesional siap membantu Anda 24/7. Konsultasi mudah, cepat, dan terpercaya.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                        <i class="fas fa-calendar-alt mr-2"></i> Buat Janji Sekarang
                    </a>
                    <a href="{{ route('dokter') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-user-md mr-2"></i> Lihat Dokter
                    </a>
                </div>
                <div class="mt-8 flex items-center gap-5">
                    <div class="flex -space-x-2">
                        <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-white flex items-center justify-center text-blue-600 font-bold text-sm">A</div>
                        <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-white flex items-center justify-center text-blue-600 font-bold text-sm">S</div>
                        <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-white flex items-center justify-center text-blue-600 font-bold text-sm">B</div>
                    </div>
                    <p class="text-sm text-blue-100"> <span class="font-bold text-white">1000+</span> Pasien telah percaya</p>
                </div>
            </div>
            <div class="hidden md:block">
                <img src="https://via.placeholder.com/500x400?text=Doctor+Illustration" alt="Dokter" class="rounded-lg shadow-xl">
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</div>

<!-- ==================== LAYANAN KAMI ==================== -->
<div class="container mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Layanan Kami</h2>
        <p class="text-gray-500 max-w-2xl mx-auto">Berbagai layanan kesehatan terbaik untuk memenuhi kebutuhan Anda dan keluarga</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-stethoscope text-2xl text-blue-500"></i>
            </div>
            <h3 class="text-lg font-bold mb-2">Konsultasi Dokter</h3>
            <p class="text-gray-500 text-sm">Konsultasi dengan dokter spesialis secara online</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-syringe text-2xl text-green-500"></i>
            </div>
            <h3 class="text-lg font-bold mb-2">Vaksinasi</h3>
            <p class="text-gray-500 text-sm">Layanan vaksinasi untuk seluruh keluarga</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-heartbeat text-2xl text-purple-500"></i>
            </div>
            <h3 class="text-lg font-bold mb-2">Cek Kesehatan</h3>
            <p class="text-gray-500 text-sm">Paket medical check up lengkap</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-pills text-2xl text-yellow-500"></i>
            </div>
            <h3 class="text-lg font-bold mb-2">Apotek Online</h3>
            <p class="text-gray-500 text-sm">Pembelian obat dengan resep digital</p>
        </div>
    </div>
</div>

<!-- ==================== STATISTIK SECTION ==================== -->
<div class="bg-blue-600 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-white">
            <div>
                <div class="text-3xl md:text-4xl font-bold">1000+</div>
                <p class="text-blue-100 mt-1">Pasien Puas</p>
            </div>
            <div>
                <div class="text-3xl md:text-4xl font-bold">20+</div>
                <p class="text-blue-100 mt-1">Dokter Spesialis</p>
            </div>
            <div>
                <div class="text-3xl md:text-4xl font-bold">50+</div>
                <p class="text-blue-100 mt-1">Layanan Medis</p>
            </div>
            <div>
                <div class="text-3xl md:text-4xl font-bold">24/7</div>
                <p class="text-blue-100 mt-1">Jam Layanan</p>
            </div>
        </div>
    </div>
</div>

<!-- ==================== DOKTER KAMI ==================== -->
<div class="container mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Dokter Kami</h2>
        <p class="text-gray-500 max-w-2xl mx-auto">Dokter-dokter profesional dan berpengalaman di bidangnya siap melayani Anda</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Dokter" class="w-full h-48 object-cover">
            <div class="p-5">
                <h3 class="text-xl font-bold mb-1">dr. Andi Wijaya, Sp.PD</h3>
                <p class="text-blue-500 text-sm mb-2">Spesialis Penyakit Dalam</p>
                <p class="text-gray-500 text-sm">⭐ 4.8 (120 pasien)</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Dokter" class="w-full h-48 object-cover">
            <div class="p-5">
                <h3 class="text-xl font-bold mb-1">dr. Siti Rahma, Sp.A</h3>
                <p class="text-blue-500 text-sm mb-2">Spesialis Anak</p>
                <p class="text-gray-500 text-sm">⭐ 4.9 (95 pasien)</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="Dokter" class="w-full h-48 object-cover">
            <div class="p-5">
                <h3 class="text-xl font-bold mb-1">dr. Budi Santoso, Sp.JP</h3>
                <p class="text-blue-500 text-sm mb-2">Spesialis Jantung</p>
                <p class="text-gray-500 text-sm">⭐ 4.9 (210 pasien)</p>
            </div>
        </div>
    </div>
    <div class="text-center mt-8">
        <a href="{{ route('dokter') }}" class="inline-flex items-center text-blue-500 hover:text-blue-600 font-semibold">
            Lihat Semua Dokter <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</div>

<!-- ==================== TESTIMONI ==================== -->
<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Apa Kata Pasien</h2>
            <p class="text-gray-500">Kepercayaan Anda adalah kebanggaan kami</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-bold">Ahmad Sudrajat</p>
                        <div class="text-yellow-400 text-sm">★★★★★</div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Pelayanan sangat baik, dokter ramah dan menjelaskan dengan detail. Recomended!</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="User" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-bold">Siti Aminah</p>
                        <div class="text-yellow-400 text-sm">★★★★★</div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Anak saya cepat sembuh setelah konsultasi dengan dr. Siti Rahma. Terima kasih Klinik Digital!</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="User" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-bold">Budi Santoso</p>
                        <div class="text-yellow-400 text-sm">★★★★☆</div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Cepat, mudah, dan praktis. Bisa konsultasi dari rumah saja.</p>
            </div>
        </div>
    </div>
</div>

<!-- ==================== CALL TO ACTION ==================== -->
<div class="container mx-auto px-4 py-16">
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-8 text-center text-white">
        <h2 class="text-2xl md:text-3xl font-bold mb-3">Siap untuk konsultasi?</h2>
        <p class="text-blue-100 mb-6">Buat janji temu sekarang dan dapatkan layanan kesehatan terbaik</p>
        <a href="{{ route('login') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition inline-flex items-center">
            <i class="fas fa-calendar-alt mr-2"></i> Buat Janji Sekarang
        </a>
    </div>
</div>
@endsection