@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Sistem')

@section('content')
<div class="space-y-6">
    <!-- Pengaturan Umum -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-building text-blue-500 mr-2"></i>
            Pengaturan Umum
        </h3>
        
        <form class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Klinik</label>
                    <input type="text" value="Klinik Digital" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telepon Klinik</label>
                    <input type="text" value="0812-3456-7890" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Klinik</label>
                    <input type="email" value="info@klinikdigital.com" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                    <input type="text" value="www.klinikdigital.com" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea rows="2" class="w-full border rounded-lg px-3 py-2">Jl. Kesehatan No. 123, Jakarta, Indonesia</textarea>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-save mr-2"></i> Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
    
    <!-- Pengaturan Jam Operasional -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-clock text-blue-500 mr-2"></i>
            Jam Operasional
        </h3>
        
        <div class="space-y-3">
            @php
                $jamOperasional = [
                    'Senin' => ['buka' => '08:00', 'tutup' => '20:00', 'libur' => false],
                    'Selasa' => ['buka' => '08:00', 'tutup' => '20:00', 'libur' => false],
                    'Rabu' => ['buka' => '08:00', 'tutup' => '20:00', 'libur' => false],
                    'Kamis' => ['buka' => '08:00', 'tutup' => '20:00', 'libur' => false],
                    'Jumat' => ['buka' => '08:00', 'tutup' => '17:00', 'libur' => false],
                    'Sabtu' => ['buka' => '09:00', 'tutup' => '15:00', 'libur' => false],
                    'Minggu' => ['buka' => '', 'tutup' => '', 'libur' => true],
                ];
            @endphp
            
            @foreach($jamOperasional as $hari => $jam)
            <div class="grid grid-cols-3 gap-4 items-center border-b pb-3">
                <div class="font-semibold">{{ $hari }}</div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="libur_{{ $loop->index }}" {{ $jam['libur'] ? 'checked' : '' }} onchange="toggleJam(this, {{ $loop->index }})">
                    <label for="libur_{{ $loop->index }}" class="text-sm text-gray-500">Libur</label>
                </div>
                <div class="flex space-x-2" id="jamFields_{{ $loop->index }}" style="{{ $jam['libur'] ? 'display: none;' : '' }}">
                    <input type="time" value="{{ $jam['buka'] }}" class="border rounded px-3 py-1 w-28" {{ $jam['libur'] ? 'disabled' : '' }}>
                    <span>-</span>
                    <input type="time" value="{{ $jam['tutup'] }}" class="border rounded px-3 py-1 w-28" {{ $jam['libur'] ? 'disabled' : '' }}>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="flex justify-end mt-4">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-save mr-2"></i> Simpan Jam Operasional
            </button>
        </div>
    </div>
    
    <!-- Pengaturan Keamanan -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-shield-alt text-blue-500 mr-2"></i>
            Pengaturan Keamanan
        </h3>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                <input type="password" placeholder="Masukkan password lama" class="w-full md:w-1/2 border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                <input type="password" placeholder="Masukkan password baru" class="w-full md:w-1/2 border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                <input type="password" placeholder="Konfirmasi password baru" class="w-full md:w-1/2 border rounded-lg px-3 py-2">
            </div>
            <div>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-key mr-2"></i> Ubah Password
                </button>
            </div>
        </div>
    </div>
    
    <!-- Pengaturan Backup -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-database text-blue-500 mr-2"></i>
            Backup & Restore
        </h3>
        
        <div class="flex space-x-4">
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-download mr-2"></i> Backup Database
            </button>
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-upload mr-2"></i> Restore Database
            </button>
        </div>
        <p class="text-sm text-gray-500 mt-3">*Backup akan menyimpan semua data ke file SQL. Restore akan mengembalikan data dari file backup.</p>
    </div>
</div>

<script>
    function toggleJam(checkbox, index) {
        const jamFields = document.getElementById('jamFields_' + index);
        const inputs = jamFields.querySelectorAll('input');
        
        if(checkbox.checked) {
            jamFields.style.display = 'none';
            inputs.forEach(input => input.disabled = true);
        } else {
            jamFields.style.display = 'flex';
            inputs.forEach(input => input.disabled = false);
        }
    }
</script>
@endsection