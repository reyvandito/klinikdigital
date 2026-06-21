<div id="modalDetailPasien" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Detail Pasien</h3>
            <button onclick="closeModalDetailPasien()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="space-y-3" id="modalDetailContent">
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Nama Lengkap</p>
                <p id="detailNama" class="font-semibold text-gray-800">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Usia</p>
                <p id="detailUsia" class="font-semibold text-gray-800">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Jenis Kelamin</p>
                <p id="detailGender" class="font-semibold text-gray-800">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Nomor HP</p>
                <p id="detailHp" class="font-semibold text-gray-800">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Alamat</p>
                <p id="detailAlamat" class="font-semibold text-gray-800">-</p>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            <button onclick="closeModalDetailPasien()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Tutup</button>
        </div>
    </div>
</div>

<script>
function openModalDetailPasien(pasienId) {
    fetch(`/dokter/pasien/detail/${pasienId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('detailNama').innerText = data.nama || '-';
            document.getElementById('detailUsia').innerText = data.usia || '-';
            document.getElementById('detailGender').innerText = data.gender || '-';
            document.getElementById('detailHp').innerText = data.hp || '-';
            document.getElementById('detailAlamat').innerText = data.alamat || '-';
            document.getElementById('modalDetailPasien').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memuat data pasien');
        });
}

function closeModalDetailPasien() {
    document.getElementById('modalDetailPasien').classList.add('hidden');
}
</script>