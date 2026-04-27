@extends('layouts.admin')

@section('title', 'Kelola Dokter')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kelola Dokter</h1>
            <p class="text-gray-600">Tambah, edit, atau hapus data dokter</p>
        </div>
        <a href="{{ route('admin.dokter.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
            <i class="fas fa-plus mr-2"></i> Tambah Dokter
        </a>
    </div>

    <!-- Tabs -->
    <div class="border-b mb-6">
        <ul class="flex space-x-4">
            <li>
                <a href="#" class="inline-block py-2 px-4 text-blue-600 border-b-2 border-blue-600 font-semibold">Semua Dokter</a>
            </li>
            <li>
                <a href="#" class="inline-block py-2 px-4 text-gray-600 hover:text-blue-600">Terverifikasi</a>
            </li>
            <li>
                <a href="#" class="inline-block py-2 px-4 text-gray-600 hover:text-blue-600">Menunggu</a>
            </li>
        </ul>
    </div>

    <!-- Table Dokter -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Spesialis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($dokters as $dokter)
                    <tr>
                        <td class="px-6 py-4">{{ $dokter['id'] }}</td>
                        <td class="px-6 py-4 font-medium">{{ $dokter['nama'] }}</td>
                        <td class="px-6 py-4">{{ $dokter['spesialis'] }}</td>
                        <td class="px-6 py-4">{{ $dokter['email'] }}</td>
                        <td class="px-6 py-4">{{ $dokter['telepon'] }}</td>
                        <td class="px-6 py-4">
                            @if($dokter['status'] == 'approved')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Terverifikasi</span>
                            @elseif($dokter['status'] == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Menunggu</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.dokter.edit', $dokter['id']) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteDokter({{ $dokter['id'] }})" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @if($dokter['status'] == 'pending')
                                <button onclick="verifyDokter({{ $dokter['id'] }})" class="text-green-500 hover:text-green-700">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function deleteDokter(id) {
        if(confirm('Yakin ingin menghapus dokter ini?')) {
            window.location.href = '/admin/dokter/delete/' + id;
        }
    }
    
    function verifyDokter(id) {
        if(confirm('Verifikasi dokter ini?')) {
            window.location.href = '/admin/dokter/verify/' + id;
        }
    }
</script>
@endsection