@extends('layouts.pasien')

@section('title', 'Kirim Keluhan / Feedback')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Kirim Keluhan / Feedback</h1>
            <p class="text-gray-500">Sampaikan keluhan, saran, atau masukan Anda untuk kami</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('pasien.feedback.store') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                        <select name="kategori" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kategori') border-red-500 @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                            <option value="dokter" {{ old('kategori') == 'dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="website" {{ old('kategori') == 'website' ? 'selected' : '' }}>Website / Sistem</option>
                            <option value="reservasi" {{ old('kategori') == 'reservasi' ? 'selected' : '' }}>Reservasi / Janji Temu</option>
                            <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subjek --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subjek *</label>
                        <input type="text" name="subjek" value="{{ old('subjek') }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('subjek') border-red-500 @enderror"
                               placeholder="Judul singkat keluhan / feedback Anda" required>
                        @error('subjek')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pesan --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pesan *</label>
                        <textarea name="pesan" rows="5" 
                                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('pesan') border-red-500 @enderror"
                                  placeholder="Jelaskan keluhan atau saran Anda secara detail..." required>{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Keluhan / Feedback
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('pasien.dashboard') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection