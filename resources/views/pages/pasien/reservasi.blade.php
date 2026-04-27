@extends('layouts.pasien')

@section('title', 'Buat Reservasi - Klinik Digital')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Buat Reservasi Konsultasi</h1>
            <p class="text-gray-600">Isi form berikut untuk membuat janji temu dengan dokter</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('pasien.reservasi.store') }}" method="POST">
                @csrf
                
                <!-- Pilih Dokter -->
                <div class="mb-4">
                    <label for="dokter_id" class="block text-gray-700 font-semibold mb-2">Pilih Dokter</label>
                    <select name="dokter_id" id="dokter_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter['id'] }}">{{ $dokter['nama'] }} - {{ $dokter['spesialis'] }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Tanggal -->
                <div class="mb-4">
                    <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal Konsultasi</label>
                    <input type="date" name="tanggal" id="tanggal" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <!-- Jam -->
                <div class="mb-4">
                    <label for="jam" class="block text-gray-700 font-semibold mb-2">Jam Konsultasi</label>
                    <select name="jam" id="jam" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Pilih Jam --</option>
                        <option value="08:00">08:00 - 09:00</option>
                        <option value="09:00">09:00 - 10:00</option>
                        <option value="10:00">10:00 - 11:00</option>
                        <option value="11:00">11:00 - 12:00</option>
                        <option value="13:00">13:00 - 14:00</option>
                        <option value="14:00">14:00 - 15:00</option>
                        <option value="15:00">15:00 - 16:00</option>
                        <option value="16:00">16:00 - 17:00</option>
                    </select>
                </div>
                
                <!-- Keluhan -->
                <div class="mb-4">
                    <label for="keluhan" class="block text-gray-700 font-semibold mb-2">Keluhan / Deskripsi</label>
                    <textarea name="keluhan" id="keluhan" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ceritakan keluhan Anda..." required></textarea>
                </div>
                
                <!-- Tombol Submit -->
                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                        <i class="fas fa-calendar-check mr-2"></i>Buat Reservasi
                    </button>
                    <a href="{{ route('dashboard.pasien') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
        
        <!-- Info -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                <div>
                    <h3 class="font-semibold text-blue-800">Informasi Penting</h3>
                    <p class="text-sm text-blue-700">Harap datang 15 menit sebelum jadwal konsultasi. Reservasi dapat dibatalkan maksimal H-1 sebelum jadwal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection