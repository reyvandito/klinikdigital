<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center">
        <h2 class="font-bold text-gray-800">Daftar Rekam Medis</h2>
        <a href="{{ route('dokter.rekam-medis.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
            <i class="fas fa-plus mr-1"></i> Buat Baru
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pasien</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Diagnosa</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tindakan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody id="rekamMedisTableBody" class="divide-y"></tbody>
        </table>
    </div>
    <div id="noData" class="text-center py-8 text-gray-500 hidden">
        <i class="fas fa-folder-open text-4xl mb-2 block"></i>
        <p>Belum ada rekam medis</p>
        <a href="{{ route('dokter.rekam-medis.create') }}" class="text-blue-500 text-sm mt-2 inline-block">Buat rekam medis pertama →</a>
    </div>
</div>

<script>
    function editRekamMedis(id) {
    window.location.href = '/dokter/rekam-medis/edit?id=' + id;
}


    function getRekamMedisList() {
        return JSON.parse(localStorage.getItem('rekamMedisList') || '[]');
    }
    
    function renderRekamMedis() {
        const data = getRekamMedisList();
        const tbody = document.getElementById('rekamMedisTableBody');
        const noData = document.getElementById('noData');
        
        if (data.length === 0) {
            tbody.innerHTML = '';
            noData.classList.remove('hidden');
            return;
        }
        
        noData.classList.add('hidden');
        let html = '';
        
        data.forEach((item, index) => {
            html += `
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">${index + 1}</td>
                    <td class="px-4 py-3 text-sm">${item.tanggal}</td>
                    <td class="px-4 py-3 text-sm font-medium">${item.pasien}</td>
                    <td class="px-4 py-3 text-sm max-w-[200px] truncate">${item.diagnosa}</td>
                    <td class="px-4 py-3 text-sm max-w-[150px] truncate">${item.tindakan}</td>
                    <td class="px-4 py-3">
                        <button onclick="detailRekamMedis(${item.id})" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="editRekamMedis(${item.id})" class="text-green-500 hover:text-green-700 mr-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="hapusRekamMedis(${item.id})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tbody.innerHTML = html;
    }
    
    function detailRekamMedis(id) {
        const data = getRekamMedisList();
        const item = data.find(i => i.id === id);
        
        if (item) {
            alert(`📋 REKAM MEDIS\n\nTanggal: ${item.tanggal}\nPasien: ${item.pasien}\n\n🔍 KELUHAN:\n${item.keluhan}\n\n📝 DIAGNOSA:\n${item.diagnosa}\n\n💊 TINDAKAN:\n${item.tindakan}\n\n💊 RESEP:\n${item.resep}\n\n📌 CATATAN:\n${item.catatan}\n\n👨‍⚕️ Dokter: ${item.dokter}`);
        }
    }
    
    function editRekamMedis(id) {
        alert('Edit rekam medis ID: ' + id);
        // Bisa redirect ke halaman edit
    }
    
    function hapusRekamMedis(id) {
        if (confirm('Hapus rekam medis ini?')) {
            let data = getRekamMedisList();
            data = data.filter(i => i.id !== id);
            localStorage.setItem('rekamMedisList', JSON.stringify(data));
            renderRekamMedis();
            alert('✅ Rekam medis berhasil dihapus');
        }
    }
    
    renderRekamMedis();
</script>