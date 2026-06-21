@props(['konsultasis' => [], 'konsultasiTerpilih' => null])

<div class="bg-white rounded-xl shadow-md p-6">
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
    @endif

    <form action="{{ route('dokter.rekam-medis.store') }}" method="POST">
        @csrf
        <div class="space-y-4">

            {{-- Pilih Konsultasi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pasien / Konsultasi *</label>
                <select name="konsultasi_id" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('konsultasi_id') border-red-500 @enderror" required>
                    <option value="">-- Pilih Konsultasi --</option>
                    @foreach($konsultasis as $k)
                        <option value="{{ $k->id }}" {{ (old('konsultasi_id') == $k->id || (isset($konsultasiTerpilih) && $konsultasiTerpilih->id == $k->id)) ? 'selected' : '' }}>
                            {{ $k->pasien->user->nama }} - {{ \Carbon\Carbon::parse($k->jadwal->tanggal)->format('d/m/Y') }} {{ $k->jadwal->jam_mulai }}
                        </option>
                    @endforeach
                </select>
                @error('konsultasi_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Diagnosa --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Diagnosa *</label>
                <textarea name="diagnosa" rows="3" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('diagnosa') border-red-500 @enderror"
                    placeholder="Tuliskan diagnosa..." required>{{ old('diagnosa') }}</textarea>
                @error('diagnosa')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tindakan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tindakan</label>
                <textarea name="tindakan" rows="3" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tuliskan tindakan yang dilakukan...">{{ old('tindakan') }}</textarea>
            </div>

            {{-- Resep --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Resep Obat</label>
                <textarea name="resep" rows="4" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Contoh: Paracetamol 500mg 3x1, Amoxicillin 500mg 3x1...">{{ old('resep') }}</textarea>
            </div>

            {{-- Catatan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                <textarea name="catatan" rows="3" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Catatan untuk pasien (anjuran, pantangan, dll)...">{{ old('catatan') }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-semibold transition">
                    <i class="fas fa-save mr-2"></i> Simpan Rekam Medis
                </button>
                <a href="{{ route('dokter.rekam-medis.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-lg font-semibold text-center transition">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>