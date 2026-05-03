@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="space-y-8">
    <!-- Status & Jadwal Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Card Status Dokter -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Status Praktik</h2>
                <i class="fas fa-user-md text-3xl text-blue-500"></i>
            </div>
            
            <form action="{{ route('dokter.update.status') }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="aktif" {{ $dokterStatus == 'aktif' ? 'checked' : '' }} class="form-radio text-green-500">
                        <span class="ml-2 text-green-700 font-semibold">Aktif</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="tidak_aktif" {{ $dokterStatus == 'tidak_aktif' ? 'checked' : '' }} class="form-radio text-red-500">
                        <span class="ml-2 text-red-700 font-semibold">Tidak Aktif</span>
                    </label>
                </div>
                
                <div class="flex items-center space-x-2">
                    <div class="flex-1">
                        @if($dokterStatus == 'aktif')
                            <span class="inline-flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-circle text-xs mr-1"></i> Sedang Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-circle text-xs mr-1"></i> Sedang Tidak Aktif
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i>Update Status
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Card Jadwal Dokter -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Jadwal Praktik</h2>
                <i class="fas fa-calendar-alt text-3xl text-blue-500"></i>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">Hari</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Jam</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalDokter as $hari => $jadwal)
                        <tr class="border-b">
                            <td class="px-4 py-2 capitalize font-semibold">{{ $hari }}</td>
                            <td class="px-4 py-2">
                                @if($jadwal['aktif'])
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Libur</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($jadwal['aktif'])
                                    {{ $jadwal['jam_mulai'] }} - {{ $jadwal['jam_selesai'] }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <button onclick="editJadwal('{{ $hari }}', {{ $jadwal['aktif'] ? 'true' : 'false' }}, '{{ $jadwal['jam_mulai'] }}', '{{ $jadwal['jam_selesai'] }}')" 
                                        class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Daftar Pasien yang Akan Konsultasi -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Daftar Pasien Yang Akan Konsultasi</h2>
            <div class="flex space-x-2">
                <button onclick="filterPasien()" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-lg text-sm transition-colors">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <button onclick="refreshData()" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-lg text-sm transition-colors">
                    <i class="fas fa-sync-alt mr-1"></i> Refresh
                </button>
            </div>
        </div>
        
        <!-- List Pasien -->
        <div class="space-y-4" id="daftarPasien">
            @foreach($pasienRequests as $pasien)
            <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow pasien-card" data-status="{{ $pasien['status'] }}">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full mr-2">
                                Antrian #{{ $pasien['no_antrian'] }}
                            </span>
                            <span class="text-sm text-gray-500">{{ $pasien['tanggal'] }} - {{ $pasien['jam'] }}</span>
                        </div>
                        
                        <h3 class="text-lg font-semibold text-gray-800">{{ $pasien['nama'] }}</h3>
                        <p class="text-sm text-gray-600">Usia: {{ $pasien['usia'] }} tahun</p>
                        
                        <div class="mt-2">
                            <p class="text-sm text-gray-700">
                                <strong>Keluhan:</strong> {{ $pasien['keluhan'] }}
                            </p>
                        </div>
                        
                        <div class="mt-3 flex items-center space-x-2">
                            @if($pasien['status'] == 'menunggu')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">
                                    <i class="fas fa-clock mr-1"></i> Menunggu
                                </span>
                            @else
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                    <i class="fas fa-check mr-1"></i> Terjadwal
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex flex-col space-y-2">
                        @if($pasien['status'] == 'menunggu')
                            <button onclick="mulaiKonsultasi({{ $pasien['id'] }})" 
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                                <i class="fas fa-play mr-1"></i> Mulai Konsultasi
                            </button>
                            <button onclick="lihatDetail({{ $pasien['id'] }})" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                                <i class="fas fa-eye mr-1"></i> Lihat Detail
                            </button>
                        @else
                            <button onclick="lihatDetail({{ $pasien['id'] }})" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                                <i class="fas fa-eye mr-1"></i> Lihat Detail
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal Edit Jadwal -->
<div id="modalJadwal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Edit Jadwal</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('dokter.update.jadwal') }}" method="POST" id="formEditJadwal">
            @csrf
            <input type="hidden" name="hari" id="edit_hari">
            <input type="hidden" name="aktif" id="edit_aktif_value">
            
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="edit_aktif_checkbox" class="form-checkbox" onchange="toggleJamFields()">
                    <span class="ml-2">Aktif</span>
                </label>
            </div>
            
            <div id="jamFields" class="space-y-3">
                <div>
                    <label class="block text-sm font-medium mb-1">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="edit_jam_mulai" class="w-full px-3 py-2 border rounded-lg">
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-1">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="edit_jam_selesai" class="w-full px-3 py-2 border rounded-lg">
                </div>
            </div>
            
            <div class="mt-4 flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Batal
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail Pasien -->
<div id="modalDetailPasien" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Detail Pasien</h3>
            <button onclick="closeModalDetail()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="space-y-3">
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Nama Lengkap</p>
                <p id="detailNama" class="font-semibold text-gray-800">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Usia</p>
                <p id="detailUsia" class="font-semibold text-gray-800">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Keluhan</p>
                <p id="detailKeluhan" class="font-semibold text-gray-800">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Tanggal Konsultasi</p>
                <p id="detailTanggal" class="font-semibold text-gray-800">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Jam Konsultasi</p>
                <p id="detailJam" class="font-semibold text-gray-800">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">No. Antrian</p>
                <p id="detailAntrian" class="font-semibold text-gray-800">-</p>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-2">
            <button onclick="closeModalDetail()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Tutup
            </button>
            <button onclick="mulaiKonsultasiDariModal()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-play mr-1"></i> Mulai Konsultasi
            </button>
        </div>
    </div>
</div>

<script>
    let currentPasienId = null;
    
    // Data dummy pasien untuk detail
    const pasienData = {
        1: { 
            nama: 'Ahmad Sudrajat', 
            usia: 35, 
            keluhan: 'Demam dan batuk selama 3 hari',
            tanggal: '2024-05-20',
            jam: '10:00',
            antrian: 1
        },
        2: { 
            nama: 'Siti Aminah', 
            usia: 28, 
            keluhan: 'Sakit kepala sebelah kanan',
            tanggal: '2024-05-20',
            jam: '11:00',
            antrian: 2
        },
        3: { 
            nama: 'Budi Santoso', 
            usia: 42, 
            keluhan: 'Nyeri ulu hati',
            tanggal: '2024-05-20',
            jam: '13:00',
            antrian: 3
        },
        4: { 
            nama: 'Rina Wati', 
            usia: 25, 
            keluhan: 'Alergi kulit',
            tanggal: '2024-05-21',
            jam: '09:00',
            antrian: 1
        }
    };
    
    // Fungsi Edit Jadwal
    function editJadwal(hari, aktif, jamMulai, jamSelesai) {
        document.getElementById('edit_hari').value = hari;
        document.getElementById('edit_aktif_checkbox').checked = aktif;
        document.getElementById('edit_aktif_value').value = aktif ? 1 : 0;
        document.getElementById('edit_jam_mulai').value = jamMulai;
        document.getElementById('edit_jam_selesai').value = jamSelesai;
        
        toggleJamFields();
        document.getElementById('modalJadwal').classList.remove('hidden');
    }
    
    function toggleJamFields() {
        const isChecked = document.getElementById('edit_aktif_checkbox').checked;
        const jamFields = document.getElementById('jamFields');
        const aktifValue = document.getElementById('edit_aktif_value');
        
        aktifValue.value = isChecked ? 1 : 0;
        
        if (isChecked) {
            jamFields.style.display = 'block';
        } else {
            jamFields.style.display = 'none';
        }
    }
    
    function closeModal() {
        document.getElementById('modalJadwal').classList.add('hidden');
    }
    
    // Fungsi Detail Pasien
    function lihatDetail(id) {
        currentPasienId = id;
        const data = pasienData[id];
        
        if(data) {
            document.getElementById('detailNama').innerText = data.nama;
            document.getElementById('detailUsia').innerText = data.usia + ' tahun';
            document.getElementById('detailKeluhan').innerText = data.keluhan;
            document.getElementById('detailTanggal').innerText = data.tanggal;
            document.getElementById('detailJam').innerText = data.jam;
            document.getElementById('detailAntrian').innerText = '#' + data.antrian;
            document.getElementById('modalDetailPasien').classList.remove('hidden');
        }
    }
    
    function closeModalDetail() {
        document.getElementById('modalDetailPasien').classList.add('hidden');
        currentPasienId = null;
    }
    
    // Fungsi Mulai Konsultasi
    function mulaiKonsultasi(id) {
        if(confirm('Mulai konsultasi dengan pasien ini?')) {
            alert('Konsultasi dimulai dengan pasien ID: ' + id);
            // window.location.href = '/dokter/konsultasi/mulai/' + id;
        }
    }
    
    function mulaiKonsultasiDariModal() {
        if(currentPasienId) {
            closeModalDetail();
            alert('Konsultasi dimulai dengan pasien');
        }
    }
    
    // Fungsi Filter dan Refresh
    function filterPasien() {
        alert('Fitur filter akan segera hadir');
    }
    
    function refreshData() {
        location.reload();
    }
</script>
@endsection