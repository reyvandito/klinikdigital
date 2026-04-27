@extends('layouts.admin')

@section('title', 'Profile Admin')
@section('page-title', 'Profile Admin')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Info -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="w-32 h-32 bg-blue-500 rounded-full flex items-center justify-center text-white text-5xl mx-auto mb-4">
                <i class="fas fa-user"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Admin Utama</h2>
            <p class="text-gray-500">Super Administrator</p>
            <div class="mt-4">
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
            </div>
            <div class="mt-6 pt-4 border-t">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg w-full">
                    <i class="fas fa-edit mr-2"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>
    
    <!-- Detail Info & Daftar Admin -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Detail Admin Utama -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Admin</h3>
            <div class="space-y-3">
                <div class="grid grid-cols-2">
                    <p class="text-gray-500">Nama Lengkap</p>
                    <p class="font-semibold">Admin Klinik Digital</p>
                </div>
                <div class="grid grid-cols-2">
                    <p class="text-gray-500">Email</p>
                    <p class="font-semibold">admin@klinikdigital.com</p>
                </div>
                <div class="grid grid-cols-2">
                    <p class="text-gray-500">Telepon</p>
                    <p class="font-semibold">0812-3456-7890</p>
                </div>
                <div class="grid grid-cols-2">
                    <p class="text-gray-500">Role</p>
                    <p class="font-semibold">Super Administrator</p>
                </div>
                <div class="grid grid-cols-2">
                    <p class="text-gray-500">Terdaftar Sejak</p>
                    <p class="font-semibold">01 Januari 2024</p>
                </div>
            </div>
        </div>
        
        <!-- Daftar Admin Lainnya -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800">Daftar Admin Lainnya</h3>
                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Admin
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @php
                            $admins = [
                                ['id' => 2, 'nama' => 'Budi Santoso', 'email' => 'budi@admin.com', 'role' => 'Administrator', 'status' => 'aktif'],
                                ['id' => 3, 'nama' => 'Siti Aminah', 'email' => 'siti@admin.com', 'role' => 'Operator', 'status' => 'aktif'],
                                ['id' => 4, 'nama' => 'Ahmad Sudrajat', 'email' => 'ahmad@admin.com', 'role' => 'Administrator', 'status' => 'nonaktif'],
                            ];
                        @endphp
                        @foreach($admins as $admin)
                        <tr>
                            <td class="px-4 py-2 font-medium">{{ $admin['nama'] }}</td>
                            <td class="px-4 py-2">{{ $admin['email'] }}</td>
                            <td class="px-4 py-2">{{ $admin['role'] }}</td>
                            <td class="px-4 py-2">
                                @if($admin['status'] == 'aktif')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700">
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
</div>
@endsection