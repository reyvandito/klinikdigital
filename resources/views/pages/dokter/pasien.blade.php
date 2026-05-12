@extends('layouts.dokter')

@section('title', 'Daftar Pasien')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Daftar Pasien</h1>
        <p class="text-gray-500">Kelola data pasien Anda</p>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama Pasien</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Usia</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Telepon</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y" id="pasienTableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Data pasien (hardcoded)
    const pasienData = [
        { id: 1, nama: 'Ahmad Sudrajat', usia: 35, gender: 'Laki-laki', telepon: '0812-3456-7890' },
        { id: 2, nama: 'Siti Aminah', usia: 28, gender: 'Perempuan', telepon: '0812-3456-7891' },
        { id: 3, nama: 'Budi Santoso', usia: 42, gender: 'Laki-laki', telepon: '0812-3456-7892' },
        { id: 4, nama: 'Rina Wati', usia: 25, gender: 'Perempuan', telepon: '0812-3456-7893' },
        { id: 5, nama: 'Dedi Firmansyah', usia: 31, gender: 'Laki-laki', telepon: '0812-3456-7894' },
        { id: 6, nama: 'Lisa Anjani', usia: 19, gender: 'Perempuan', telepon: '0812-3456-7895' }
    ];
    
    function renderPasien() {
        let html = '';
        pasienData.forEach((pasien, index) => {
            html += `
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">${index + 1}</td>
                    <td class="px-4 py-3 text-sm font-medium">${pasien.nama}</td>
                    <td class="px-4 py-3 text-sm">${pasien.usia} tahun</td>
                    <td class="px-4 py-3 text-sm">${pasien.gender}</td>
                    <td class="px-4 py-3 text-sm">${pasien.telepon}</td>
                    <td class="px-4 py-3">
                        <a href="/dokter/pasien/detail/${pasien.id}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                    </td>
                </tr>
            `;
        });
        document.getElementById('pasienTableBody').innerHTML = html;
    }
    
    renderPasien();
</script>
@endsection