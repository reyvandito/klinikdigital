<div class="bg-white rounded-xl shadow-md p-6">
    <form id="editRekamMedisForm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informasi Pasien -->
            <div class="space-y-4">
                <h3 class="font-bold text-gray-800 border-b pb-2">Informasi Pasien</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pasien *</label>
                    <select id="pasien" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Pilih Pasien --</option>
                        <option value="1">Ahmad Sudrajat (Umur: 35)</option>
                        <option value="2">Siti Aminah (Umur: 28)</option>
                        <option value="3">Budi Santoso (Umur: 42)</option>
                        <option value="4">Rina Wati (Umur: 25)</option>
                        <option value="5">Dedi Firmansyah (Umur: 31)</option>
                        <option value="6">Lisa Anjani (Umur: 19)</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pemeriksaan *</label>
                    <input type="date" id="tanggal" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            
            <!-- Informasi Pemeriksaan -->
            <div class="space-y-4">
                <h3 class="font-bold text-gray-800 border-b pb-2">Informasi Pemeriksaan</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tinggi Badan (cm)</label>
                    <input type="number" id="tinggi" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Berat Badan (kg)</label>
                    <input type="number" id="berat" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tekanan Darah</label>
                    <input type="text" id="tekanan" placeholder="Contoh: 120/80" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>
        
        <!-- Keluhan & Diagnosa -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Keluhan *</label>
                <textarea id="keluhan" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Keluhan pasien..." required></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Diagnosa *</label>
                <textarea id="diagnosa" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Hasil diagnosa..." required></textarea>
            </div>
        </div>
        
        <!-- Tindakan & Resep -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tindakan Medis</label>
                <textarea id="tindakan" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tindakan yang dilakukan..."></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Resep Obat</label>
                <textarea id="resep" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nama obat, dosis, aturan pakai..."></textarea>
            </div>
        </div>
        
        <!-- Catatan Tambahan -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
            <textarea id="catatan" rows="2" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Catatan penting lainnya..."></textarea>
        </div>
        
        <!-- Tombol -->
        <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="window.history.back()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Batal
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                <i class="fas fa-save mr-2"></i> Update Rekam Medis
            </button>
        </div>
    </form>
</div>

<script>
    // Ambil ID dari URL parameter 'id'
    const urlParams = new URLSearchParams(window.location.search);
    const rekamMedisId = parseInt(urlParams.get('id'));
    
    function getRekamMedisList() {
        return JSON.parse(localStorage.getItem('rekamMedisList') || '[]');
    }
    
    function saveRekamMedisList(data) {
        localStorage.setItem('rekamMedisList', JSON.stringify(data));
    }
    
    function loadData() {
        if (!rekamMedisId) {
            alert('ID rekam medis tidak ditemukan!');
            window.location.href = '/dokter/rekam-medis';
            return;
        }
        
        const data = getRekamMedisList();
        const item = data.find(i => i.id === rekamMedisId);
        
        if (item) {
            // Set nilai ke form
            const pasienSelect = document.getElementById('pasien');
            for (let i = 0; i < pasienSelect.options.length; i++) {
                if (pasienSelect.options[i].text === item.pasien) {
                    pasienSelect.selectedIndex = i;
                    break;
                }
            }
            
            document.getElementById('tanggal').value = item.tanggal;
            document.getElementById('tinggi').value = (item.tinggi && item.tinggi !== '-') ? item.tinggi : '';
            document.getElementById('berat').value = (item.berat && item.berat !== '-') ? item.berat : '';
            document.getElementById('tekanan').value = (item.tekanan && item.tekanan !== '-') ? item.tekanan : '';
            document.getElementById('keluhan').value = item.keluhan;
            document.getElementById('diagnosa').value = item.diagnosa;
            document.getElementById('tindakan').value = (item.tindakan && item.tindakan !== '-') ? item.tindakan : '';
            document.getElementById('resep').value = (item.resep && item.resep !== '-') ? item.resep : '';
            document.getElementById('catatan').value = (item.catatan && item.catatan !== '-') ? item.catatan : '';
        } else {
            alert('Data tidak ditemukan!');
            window.location.href = '/dokter/rekam-medis';
        }
    }
    
    document.getElementById('editRekamMedisForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Ambil nilai dari form
        const pasien = document.getElementById('pasien');
        const pasienNama = pasien.options[pasien.selectedIndex]?.text || '';
        const tanggal = document.getElementById('tanggal').value;
        const tinggi = document.getElementById('tinggi').value;
        const berat = document.getElementById('berat').value;
        const tekanan = document.getElementById('tekanan').value;
        const keluhan = document.getElementById('keluhan').value;
        const diagnosa = document.getElementById('diagnosa').value;
        const tindakan = document.getElementById('tindakan').value;
        const resep = document.getElementById('resep').value;
        const catatan = document.getElementById('catatan').value;
        
        // Validasi
        if (!pasien.value || !tanggal || !keluhan || !diagnosa) {
            alert('Harap isi semua field yang wajib (*)!');
            return;
        }
        
        // Update data
        let rekamMedisList = getRekamMedisList();
        const index = rekamMedisList.findIndex(i => i.id === rekamMedisId);
        
        if (index !== -1) {
            rekamMedisList[index] = {
                ...rekamMedisList[index],
                pasien: pasienNama,
                pasienId: pasien.value,
                tanggal: tanggal,
                tinggi: tinggi || '-',
                berat: berat || '-',
                tekanan: tekanan || '-',
                keluhan: keluhan,
                diagnosa: diagnosa,
                tindakan: tindakan || '-',
                resep: resep || '-',
                catatan: catatan || '-',
                updated_at: new Date().toLocaleDateString('id-ID')
            };
            
            saveRekamMedisList(rekamMedisList);
            alert('✅ Rekam medis berhasil diupdate!');
            window.location.href = '/dokter/rekam-medis';
        } else {
            alert('Data tidak ditemukan!');
        }
    });
    
    // Load data saat halaman dibuka
    loadData();
</script>