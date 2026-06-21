@props(['rekamMedis' => null])

<div class="bg-white rounded-xl shadow-md p-6">
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
    @endif

    @if($rekamMedis)
    <form action="{{ route('dokter.rekam-medis.update', $rekamMedis->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informasi Pasien -->
            <div class="space-y-4">
                <h3 class="font-bold text-gray-800 border-b pb-2">Informasi Pasien</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pasien</label>
                    <input type="text" value="{{ $rekamMedis->konsultasi->pasien->user->nama ?? '-' }}" 
                           class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Konsultasi</label>
                    <input type="text" value="{{ \Carbon\Carbon::parse($rekamMedis->konsultasi->jadwal->tanggal)->format('d/m/Y') }}" 
                           class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>
                </div>
            </div>
            
            <!-- Informasi Pemeriksaan -->
            <div class="space-y-4">
                <h3 class="font-bold text-gray-800 border-b pb-2">Informasi Pemeriksaan</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
                    <textarea rows="3" class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>{{ $rekamMedis->konsultasi->keluhan ?? '-' }}</textarea>
                </div>
            </div>
        </div>
        
        <!-- Diagnosa -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Diagnosa *</label>
            <textarea name="diagnosa" rows="4" 
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('diagnosa') border-red-500 @enderror"
                required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
            @error('diagnosa')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Tindakan -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tindakan Medis</label>
            <textarea name="tindakan" rows="3" 
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Tindakan yang dilakukan...">{{ old('tindakan', $rekamMedis->tindakan) }}</textarea>
        </div>
        
        <!-- Resep -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Resep Obat</label>
            <textarea name="resep" rows="4" 
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Nama obat, dosis, aturan pakai...">{{ old('resep', $rekamMedis->resep) }}</textarea>
        </div>
        
        <!-- Catatan -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
            <textarea name="catatan" rows="2" 
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Catatan penting lainnya...">{{ old('catatan', $rekamMedis->catatan) }}</textarea>
        </div>
        
        <!-- Tombol -->
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('dokter.rekam-medis.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                <i class="fas fa-save mr-2"></i> Update Rekam Medis
            </button>
        </div>
    </form>
    @else
    <div class="text-center py-8 text-red-500">
        <i class="fas fa-exclamation-triangle text-4xl mb-2 block"></i>
        <p>Data rekam medis tidak ditemukan</p>
    </div>
    @endif
</div>