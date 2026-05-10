@extends('layouts.home')

@section('title', 'Dokter Kami - Klinik Digital')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">👨‍⚕️ Dokter Kami</h1>
        <p class="text-gray-500 text-lg max-w-2xl mx-auto">Dokter-dokter profesional dan berpengalaman di bidangnya siap memberikan pelayanan terbaik untuk Anda</p>
    </div>

    <!-- Filter Section -->
    <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
        <div class="flex flex-wrap gap-2">
            <button onclick="filterDokter('semua')" class="filter-btn active bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Semua</button>
            <button onclick="filterDokter('penyakit-dalam')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">Penyakit Dalam</button>
            <button onclick="filterDokter('anak')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">Spesialis Anak</button>
            <button onclick="filterDokter('jantung')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">Spesialis Jantung</button>
            <button onclick="filterDokter('mata')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">Spesialis Mata</button>
            <button onclick="filterDokter('kulit')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">Spesialis Kulit</button>
            <button onclick="filterDokter('kandungan')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">Spesialis Kandungan</button>
        </div>
        <div class="relative">
            <input type="text" id="searchInput" onkeyup="searchDokter()" placeholder="Cari dokter..." class="pl-10 pr-4 py-2 border rounded-lg w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
    </div>

    <!-- Dokter Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="dokterContainer">
        <!-- Akan diisi JavaScript -->
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-12" id="loadMoreContainer">
        <button onclick="loadMore()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition">
            <i class="fas fa-sync-alt mr-2"></i> Load More
        </button>
    </div>

    <!-- No Result -->
    <div id="noResult" class="text-center py-12 hidden">
        <i class="fas fa-user-md text-6xl text-gray-300 mb-4"></i>
        <p class="text-gray-500 text-lg">Tidak ada dokter yang ditemukan</p>
    </div>
</div>

<script>
    // Data dokter (hardcoded)
    const dokterData = [
        { id: 1, nama: 'dr. Andi Wijaya, Sp.PD', spesialis: 'penyakit-dalam', spesialisLabel: 'Spesialis Penyakit Dalam', rating: 4.8, pasien: 1200, pengalaman: '12 tahun', foto: 'https://rumahsakitgalericandra.com/services/assets/upload/dokter/DOC012/profile-1762241409-bdf2c7bf.png', jadwal: 'Senin - Jumat, 09:00 - 17:00', harga: 'Rp 200.000' },
        { id: 2, nama: 'dr. Siti Rahma, Sp.A', spesialis: 'anak', spesialisLabel: 'Spesialis Anak', rating: 4.9, pasien: 950, pengalaman: '8 tahun', foto: 'https://www.medicelle.co.id/wp-content/uploads/2020/01/dr.-Niken-Wening-Suryanti-SpOG-profile-web.jpg', jadwal: 'Senin - Sabtu, 08:00 - 15:00', harga: 'Rp 180.000' },
        { id: 3, nama: 'dr. Budi Santoso, Sp.JP', spesialis: 'jantung', spesialisLabel: 'Spesialis Jantung', rating: 4.9, pasien: 2100, pengalaman: '15 tahun', foto: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmnE5F4DpBBexE9hE9JuTeEHZQZUi1Gh7PxA&s', jadwal: 'Selasa - Sabtu, 10:00 - 18:00', harga: 'Rp 350.000' },
        { id: 4, nama: 'dr. Maya Sari, Sp.M', spesialis: 'mata', spesialisLabel: 'Spesialis Mata', rating: 4.7, pasien: 750, pengalaman: '7 tahun', foto: 'https://rsjpparamarta.com/images/dr-annisa-tri-kusuma-spn-TQ.png', jadwal: 'Senin - Kamis, 09:00 - 16:00', harga: 'Rp 200.000' },
        { id: 5, nama: 'dr. Reyvan Dito Bassam Camilo, Sp.KK', spesialis: 'kulit', spesialisLabel: 'Spesialis Kulit & Kelamin', rating: 4.8, pasien: 890, pengalaman: '6 tahun', foto: '{{  asset("images/reypan.jpeg") }}', jadwal: 'Rabu - Minggu, 11:00 - 19:00', harga: 'Rp 220.000' },
        { id: 6, nama: 'dr. Lina Herawati, Sp.OG', spesialis: 'kandungan', spesialisLabel: 'Spesialis Kandungan', rating: 4.9, pasien: 1850, pengalaman: '12 tahun', foto: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiyFiMGfRTq6TCRKtlSMJGJQkY9YVUNAPKmA&s.jpg', jadwal: 'Senin - Jumat, 08:00 - 20:00', harga: 'Rp 250.000' },
        { id: 7, nama: 'dr. hayrunisa, Sp.B', spesialis: 'bedah', spesialisLabel: 'Spesialis Bedah', rating: 4.8, pasien: 680, pengalaman: '10 tahun', foto: '{{ asset("images/turkey.jpeg") }}', jadwal: 'Senin - Jumat, 09:00 - 16:00', harga: 'Rp 400.000' },
        { id: 8, nama: 'dr. Amedeo Duschar, Sp.THT', spesialis: 'tht', spesialisLabel: 'Spesialis THT', rating: 4.7, pasien: 540, pengalaman: '26 tahun', foto: '{{  asset("images/deyoq.png") }}', jadwal: 'Selasa - Sabtu, 10:00 - 17:00', harga: 'Rp 210.000' }
    ];

    let currentFilter = 'semua';
    let currentSearch = '';
    let currentLimit = 6;

    function renderDokter() {
        let filteredData = dokterData;
        
        // Filter berdasarkan spesialis
        if (currentFilter !== 'semua') {
            filteredData = filteredData.filter(d => d.spesialis === currentFilter);
        }
        
        // Filter berdasarkan search
        if (currentSearch !== '') {
            filteredData = filteredData.filter(d => 
                d.nama.toLowerCase().includes(currentSearch.toLowerCase()) ||
                d.spesialisLabel.toLowerCase().includes(currentSearch.toLowerCase())
            );
        }
        
        // Limit untuk load more
        const displayData = filteredData.slice(0, currentLimit);
        const totalData = filteredData.length;
        
        // Render HTML
        let html = '';
        for (const d of displayData) {
            const fullStars = Math.floor(d.rating);
            const halfStar = d.rating % 1 >= 0.5;
            let starsHtml = '';
            
            for (let i = 1; i <= 5; i++) {
                if (i <= fullStars) {
                    starsHtml += '<i class="fas fa-star text-yellow-400"></i>';
                } else if (i === fullStars + 1 && halfStar) {
                    starsHtml += '<i class="fas fa-star-half-alt text-yellow-400"></i>';
                } else {
                    starsHtml += '<i class="far fa-star text-yellow-400"></i>';
                }
            }
            
            html += `
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 dokter-card" data-specialist="${d.spesialis}">
                    <div class="relative">
                        <img src="${d.foto}" alt="${d.nama}" class="w-full h-56 object-cover">
                        <div class="absolute top-2 right-2 bg-white rounded-full px-2 py-1 text-xs font-semibold text-blue-600 shadow">
                            ⭐ ${d.rating}
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">${d.nama}</h3>
                        <p class="text-blue-500 text-sm mb-2">${d.spesialisLabel}</p>
                        <div class="flex items-center gap-1 mb-3">
                            ${starsHtml}
                            <span class="text-gray-500 text-xs ml-1">(${d.pasien} pasien)</span>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-briefcase w-5 text-gray-400"></i>
                                <span>Pengalaman ${d.pengalaman}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>${d.jadwal}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-tag w-5 text-gray-400"></i>
                                <span>${d.harga} / konsultasi</span>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded-lg font-semibold transition">
                            <i class="fas fa-calendar-check mr-2"></i> Buat Janji
                        </a>
                    </div>
                </div>
            `;
        }
        
        const container = document.getElementById('dokterContainer');
        const noResult = document.getElementById('noResult');
        const loadMoreContainer = document.getElementById('loadMoreContainer');
        
        if (html === '') {
            container.innerHTML = '';
            noResult.classList.remove('hidden');
            loadMoreContainer.classList.add('hidden');
        } else {
            container.innerHTML = html;
            noResult.classList.add('hidden');
            
            if (currentLimit >= totalData) {
                loadMoreContainer.classList.add('hidden');
            } else {
                loadMoreContainer.classList.remove('hidden');
            }
        }
    }

    function filterDokter(filter) {
        currentFilter = filter;
        currentLimit = 6;
        
        // Update active class pada button
        const buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(btn => {
            if (filter === 'semua' && btn.innerText === 'Semua') {
                btn.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
                btn.classList.add('bg-blue-600', 'text-white');
            } else if (btn.innerText.toLowerCase().replace(' ', '-') === filter && filter !== 'semua') {
                btn.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
                btn.classList.add('bg-blue-600', 'text-white');
            } else {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
            }
        });
        
        renderDokter();
    }

    function searchDokter() {
        currentSearch = document.getElementById('searchInput').value;
        currentLimit = 6;
        renderDokter();
    }

    function loadMore() {
        currentLimit += 3;
        renderDokter();
    }

    // Initial render
    renderDokter();
</script>

<style>
    .dokter-card {
        transition: all 0.3s ease;
    }
</style>
@endsection