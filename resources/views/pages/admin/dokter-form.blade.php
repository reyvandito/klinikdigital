@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">{{ isset($dokter) ? 'Edit Dokter' : 'Tambah Dokter Baru' }}</h1>

        <form action="{{ isset($dokter) ? route('admin.dokter.update', $dokter->id) : route('admin.dokter.store') }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf
            @if(isset($dokter)) @method('PUT') @endif

            {{-- UPLOAD FOTO --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Foto Dokter</label>
                
                @if(isset($dokter) && $dokter->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $dokter->foto) }}" class="w-24 h-24 object-cover rounded-full">
                    </div>
                @endif
                
                <input type="file" name="foto" accept="image/*" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500">
                <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG. Maksimal 2MB</p>
                @error('foto') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $dokter->user->nama ?? '') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 @error('nama') border-red-500 @enderror" required>
                @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $dokter->user->email ?? '') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror" required>
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nomor HP</label>
                <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $dokter->user->nomor_hp ?? '') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 @error('nomor_hp') border-red-500 @enderror" required>
                @error('nomor_hp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500" 
                       {{ isset($dokter) ? 'placeholder="Kosongkan jika tidak diubah"' : 'required' }}>
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Spesialis</label>
                <input type="text" name="spesialis" value="{{ old('spesialis', $dokter->spesialis ?? '') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 @error('spesialis') border-red-500 @enderror" required>
                @error('spesialis') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">No STR</label>
                <input type="text" name="no_str" value="{{ old('no_str', $dokter->no_str ?? '') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 @error('no_str') border-red-500 @enderror" required>
                @error('no_str') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Pilih</option>
                    <option value="L" {{ old('jenis_kelamin', $dokter->user->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $dokter->user->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.dokter.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    {{ isset($dokter) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection