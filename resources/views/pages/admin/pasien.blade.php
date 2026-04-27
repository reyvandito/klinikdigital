@extends('layouts.admin')

@section('title', 'Kelola Pasien')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kelola Pasien</h1>
            <p class="text-gray-600">Tambah, edit, atau hapus data pasien</p>
        </div>
        <a href="{{ route('admin.pasien.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
            <i class="fas fa-plus mr-2"></i> Tambah Pasien
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pasiens as $pasien)
                    <tr>
                        <td class="px-6 py-4">{{ $pasien['id'] }}</td>
                        <td class="px-6 py-4 font-medium">{{ $pasien['nama'] }}</td>
                        <td class="px-6 py-4">{{ $pasien['email'] }}</td>
                        <td class="px-6 py-4">{{ $pasien['telepon'] }}</td>
                        <td class="px-6 py-4">{{ date('d/m/Y', strtotime($pasien['tanggal_daftar'])) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.pasien.edit', $pasien['id']) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deletePasien({{ $pasien['id'] }})" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
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
    function deletePasien(id) {
        if(confirm('Yakin ingin menghapus pasien ini?')) {
            window.location.href = '/admin/pasien/delete/' + id;
        }
    }
</script>
@endsection