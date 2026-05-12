@extends('layouts.dokter')

@section('title', 'Detail Pasien')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="{{ url('/dokter/pasien') }}" class="inline-flex items-center text-blue-500 hover:text-blue-600 mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pasien
        </a>
        
        <!-- Card Detail Pasien -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Detail Pasien</h2>
            </div>
            
            <div class="p-6" id="detailPasienContainer">
                <!-- Akan diisi JavaScript -->
            </div>
        </div>
        
        <!-- Riwayat Konsultasi -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">Riwayat Konsultasi</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Keluhan</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Diagnosa</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody id="riwayatTableBody" class="divide-y"></tbody>
                </table>
            </div>
        </div>
        
        <!-- Form Catatan -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">Tambah Catatan</h2>
            </div>
            <div class="p-6">
                <form id="catatanForm">
                    <textarea id="catatan" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis catatan untuk pasien..."></textarea>
                    <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-save mr-2"></i> Simpan Catatan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Data pasien
    const pasienList = {
        1: { nama: 'Ahmad Sudrajat', usia: 35, gender: 'Laki-laki', telepon: '0812-3456-7890', email: 'ahmad@gmail.com', alamat: 'Jakarta Selatan' },
        2: { nama: 'Siti Aminah', usia: 28, gender: 'Perempuan', telepon: '0812-3456-7891', email: 'siti@gmail.com', alamat: 'Jakarta Barat' },
        3: { nama: 'Budi Santoso', usia: 42, gender: 'Laki-laki', telepon: '0812-3456-7892', email: 'budi@gmail.com', alamat: 'Jakarta Timur' },
        4: { nama: 'Rina Wati', usia: 25, gender: 'Perempuan', telepon: '0812-3456-7893', email: 'rina@gmail.com', alamat: 'Jakarta Utara' },
        5: { nama: 'Dedi Firmansyah', usia: 31, gender: 'Laki-laki', telepon: '0812-3456-7894', email: 'dedi@gmail.com', alamat: 'Jakarta Pusat' },
        6: { nama: 'Lisa Anjani', usia: 19, gender: 'Perempuan', telepon: '0812-3456-7895', email: 'lisa@gmail.com', alamat: 'Bekasi' }
    };
    
    // Data riwayat konsultasi
    const riwayatKonsultasi = {
        1: [
            { tanggal: '10 Mei 2024', keluhan: 'Demam dan batuk', diagnosa: 'Infeksi saluran pernapasan', status: 'Selesai' },
            { tanggal: '25 Maret 2024', keluhan: 'Sakit kepala', diagnosa: 'Migrain', status: 'Selesai' }
        ],
        2: [
            { tanggal: '15 April 2024', keluhan: 'Demam tinggi', diagnosa: 'Demam berdarah', status: 'Selesai' }
        ],
        3: [
            { tanggal: '20 Mei 2024', keluhan: 'Nyeri dada', diagnosa: 'Gangguan jantung', status: 'Dalam Perawatan' }
        ],
        4: [
            { tanggal: '5 Mei 2024', keluhan: 'Alergi kulit', diagnosa: 'Dermatitis', status: 'Selesai' }
        ],
        5: [],
        6: []
    };
    
    // Ambil ID dari URL
    const urlSegments = window.location.pathname.split('/');
    const pasienId = parseInt(urlSegments[urlSegments.length - 1]);
    
    function loadDetailPasien() {
        const pasien = pasienList[pasienId];
        if (pasien) {
            const html = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="font-semibold text-gray-800">${pasien.nama}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Usia</p>
                        <p class="font-semibold text-gray-800">${pasien.usia} tahun</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p class="font-semibold text-gray-800">${pasien.gender}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Telepon</p>
                        <p class="font-semibold text-gray-800">${pasien.telepon}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-semibold text-gray-800">${pasien.email}</p>
                    </div>
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="font-semibold text-gray-800">${pasien.alamat}</p>
                    </div>
                </div>
            `;
            document.getElementById('detailPasienContainer').innerHTML = html;
        } else {
            document.getElementById('detailPasienContainer').innerHTML = '<p class="text-center text-red-500">Pasien tidak ditemukan</p>';
        }
    }
    
    function loadRiwayat() {
        const riwayat = riwayatKonsultasi[pasienId] || [];
        let html = '';
        
        if (riwayat.length === 0) {
            html = `
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 block"></i>
                        Belum ada riwayat konsultasi
                    </td>
                </tr>
            `;
        } else {
            riwayat.forEach(item => {
                const statusClass = item.status === 'Selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700';
                html += `
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">${item.tanggal}</td>
                        <td class="px-4 py-3 text-sm">${item.keluhan}</td>
                        <td class="px-4 py-3 text-sm">${item.diagnosa}</td>
                        <td class="px-4 py-3"><span class="${statusClass} text-xs px-2 py-1 rounded-full">${item.status}</span></td>
                    </tr>
                `;
            });
        }
        
        document.getElementById('riwayatTableBody').innerHTML = html;
    }
    
    // Simpan catatan ke localStorage
    document.getElementById('catatanForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const catatan = document.getElementById('catatan').value;
        
        if (catatan.trim() === '') {
            alert('Harap isi catatan!');
            return;
        }
        
        let semuaCatatan = JSON.parse(localStorage.getItem('catatanPasien') || '{}');
        if (!semuaCatatan[pasienId]) {
            semuaCatatan[pasienId] = [];
        }
        semuaCatatan[pasienId].push({
            tanggal: new Date().toLocaleDateString('id-ID'),
            jam: new Date().toLocaleTimeString(),
            catatan: catatan
        });
        localStorage.setItem('catatanPasien', JSON.stringify(semuaCatatan));
        
        alert('✅ Catatan berhasil disimpan!');
        document.getElementById('catatan').value = '';
    });
    
    loadDetailPasien();
    loadRiwayat();
</script>
@endsection