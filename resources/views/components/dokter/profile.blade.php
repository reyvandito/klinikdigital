@extends('layouts.dokter')

@section('title', 'Profil Dokter')
@section('page-title', 'Profil Dokter')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center overflow-hidden">
            @if($dokter->foto && file_exists(public_path('storage/' . $dokter->foto)))
                <img src="{{ asset('storage/' . $dokter->foto) }}" alt="{{ $dokter->user->nama }}" class="w-full h-full object-cover">
            @else
                <i class="fas fa-user-md text-4xl text-blue-500"></i>
            @endif
        </div>
        <div>
            <h2 class="text-xl font-bold text-gray-800">{{ $dokter->user->nama }}</h2>
            <p class="text-gray-500">{{ $dokter->spesialis }}</p>
            <p class="text-sm text-gray-400">STR: {{ $dokter->no_str }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('dokter.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Foto --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                <input type="file" name="foto" accept="image/*" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB</p>
                @error('foto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror" required>
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor HP --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nomor_hp') border-red-500 @enderror">
                @error('nomor_hp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Spesialis --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Spesialis *</label>
                <input type="text" name="spesialis" value="{{ old('spesialis', $dokter->spesialis) }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('spesialis') border-red-500 @enderror" required>
                @error('spesialis')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- No STR (Readonly) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No STR</label>
                <input type="text" value="{{ $dokter->no_str }}" 
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-500" readonly>
                <p class="text-xs text-gray-400 mt-1">No STR tidak dapat diubah</p>
            </div>
        </div>

        {{-- Password --}}
        <div class="mt-6 border-t pt-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Ubah Password</h3>
            <p class="text-sm text-gray-500 mb-4">Kosongkan jika tidak ingin mengubah password</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                           placeholder="Masukkan password baru">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Ulangi password baru">
                </div>
            </div>
        </div>

        {{-- Informasi Akun --}}
        <div class="mt-6 border-t pt-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="font-semibold text-gray-700 mb-2">Informasi Akun</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Role</span>
                        <p class="font-medium text-gray-800">
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">Dokter</span>
                        </p>
                    </div>
                    <div>
                        <span class="text-gray-500">Status</span>
                        <p class="font-medium text-gray-800">
                            <span class="px-2 py-1 rounded-full text-xs {{ $dokter->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $dokter->status == 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <span class="text-gray-500">Bergabung Sejak</span>
                        <p class="font-medium text-gray-800">{{ $user->created_at ? $user->created_at->format('d F Y') : '-' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Terakhir Diperbarui</span>
                        <p class="font-medium text-gray-800">{{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection