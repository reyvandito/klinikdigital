@extends('layouts.admin')

@section('title', 'Manajemen Reservasi')
@section('page-title', 'Manajemen Reservasi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Reservasi Pasien</h2>
            <p class="text-gray-600">Semua reservasi yang dilakukan pasien untuk konsultasi</p>
        </div>
        <div class="flex space-x-2">
            <button onclick="window.print()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                <i class="fas fa-print mr-2"></i> Print
            </button>
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                <i class="fas fa-download mr-2"></i> Export
            </button>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="menunggu">Menunggu</option>
                <option value="terjadwal">Terjadwal</option>
                <option value="selesai">Selesai</option>
                <option value="batal">Batal</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Dokter</label>
            <select class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Dokter</option>
                <option value="1">dr. Andi Wijaya, Sp.PD</option>
                <option value="2">dr. Siti Rahma, Sp.A</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
            <input type="date" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
            <input type="date" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>
    
    <!-- Tabel Reservasi -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pasien</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluhan</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($reservasis as $reservasi)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $reservasi['id'] }}</td>
                    <td class="px-4 py-3 font-medium">{{ $reservasi['pasien'] }}</td>
                    <td class="px-4 py-3">{{ $reservasi['dokter'] }}</td>
                    <td class="px-4 py-3">{{ date('d/m/Y', strtotime($reservasi['tanggal'])) }}</td>
                    <td class="px-4 py-3">{{ $reservasi['jam'] }}</td>
                    <td class="px-4 py-3 text-sm">{{ \Illuminate\Support\Str::limit($reservasi['keluhan'], 30) }}</td>
                    <td class="px-4 py-3">
                        @if($reservasi['status'] == 'menunggu')
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Menunggu</span>
                        @elseif($reservasi['status'] == 'terjadwal')
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Terjadwal</span>
                        @elseif($reservasi['status'] == 'selesai')
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Selesai</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Batal</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex space-x-2">
                            <button onclick="lihatDetail({{ $reservasi['id'] }})" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </button>
                            <select onchange="updateStatus(this, {{ $reservasi['id'] }})" class="border rounded px-2 py-1 text-xs">
                                <option value="menunggu" {{ $reservasi['status'] == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="terjadwal" {{ $reservasi['status'] == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                                <option value="selesai" {{ $reservasi['status'] == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $reservasi['status'] == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        <p class="text-sm text-gray-500">Menampilkan 1-4 dari 4 data</p>
        <div class="flex space-x-2">
            <button class="px-3 py-1 border rounded hover:bg-gray-100 disabled:opacity-50" disabled>Previous</button>
            <button class="px-3 py-1 bg-blue-500 text-white rounded">1</button>
            <button class="px-3 py-1 border rounded hover:bg-gray-100 disabled:opacity-50" disabled>Next</button>
        </div>
    </div>
</div>

<!-- Modal Detail Reservasi -->
<div id="modalDetail" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Detail Reservasi</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="space-y-3">
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">ID Reservasi</p>
                <p id="detailId" class="font-semibold">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Pasien</p>
                <p id="detailPasien" class="font-semibold">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Dokter</p>
                <p id="detailDokter" class="font-semibold">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Tanggal & Jam</p>
                <p id="detailTanggalJam" class="font-semibold">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Keluhan</p>
                <p id="detailKeluhan" class="font-semibold">-</p>
            </div>
            <div class="border-b pb-2">
                <p class="text-sm text-gray-500">Status</p>
                <p id="detailStatus" class="font-semibold">-</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    const reservasiData = @json($reservasis);
    
    function lihatDetail(id) {
        const data = reservasiData.find(r => r.id == id);
        if(data) {
            document.getElementById('detailId').innerText = data.id;
            document.getElementById('detailPasien').innerText = data.pasien;
            document.getElementById('detailDokter').innerText = data.dokter;
            document.getElementById('detailTanggalJam').innerText = data.tanggal + ' - ' + data.jam;
            document.getElementById('detailKeluhan').innerText = data.keluhan;
            document.getElementById('detailStatus').innerText = data.status;
            document.getElementById('modalDetail').classList.remove('hidden');
        }
    }
    
    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
    }
    
    function updateStatus(select, id) {
        const newStatus = select.value;
        if(confirm('Ubah status reservasi ini menjadi ' + newStatus + '?')) {
            window.location.href = '/admin/reservasi/update-status/' + id + '?status=' + newStatus;
        }
    }
</script>
@endsection