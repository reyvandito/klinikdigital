@extends('layouts.admin')

@section('title', 'Kelola Jadwal Konsultasi')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Jadwal Konsultasi</h1>
        <p class="text-gray-600">Lihat dan kelola jadwal konsultasi pasien dengan dokter</p>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pasien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($jadwals as $jadwal)
                    <tr>
                        <td class="px-6 py-4">{{ $jadwal['id'] }}</td>
                        <td class="px-6 py-4 font-medium">{{ $jadwal['pasien'] }}</td>
                        <td class="px-6 py-4">{{ $jadwal['dokter'] }}</td>
                        <td class="px-6 py-4">{{ date('d/m/Y', strtotime($jadwal['tanggal'])) }}</td>
                        <td class="px-6 py-4">{{ $jadwal['jam'] }}</td>
                        <td class="px-6 py-4">
                            @if($jadwal['status'] == 'menunggu')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Menunggu</span>
                            @elseif($jadwal['status'] == 'terjadwal')
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Terjadwal</span>
                            @elseif($jadwal['status'] == 'selesai')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Selesai</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Batal</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <select onchange="updateStatus({{ $jadwal['id'] }}, this.value)" class="border rounded px-2 py-1 text-sm">
                                <option value="menunggu" {{ $jadwal['status'] == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="terjadwal" {{ $jadwal['status'] == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                                <option value="selesai" {{ $jadwal['status'] == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $jadwal['status'] == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function updateStatus(id, status) {
        if(confirm('Ubah status jadwal ini?')) {
            window.location.href = '/admin/jadwal/update-status/' + id + '?status=' + status;
        }
    }
</script>
@endsection