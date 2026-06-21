<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">Status Praktik</h2>
        <i class="fas fa-user-md text-3xl text-blue-500"></i>
    </div>
    
    <div class="space-y-4">
        <div class="flex items-center space-x-4">
            <form action="{{ route('dokter.update.status') }}" method="POST" class="w-full">
                @csrf
                <div class="flex items-center space-x-4 mb-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="status" value="aktif" class="status-radio" 
                               {{ ($dokter->status ?? 'aktif') == 'aktif' ? 'checked' : '' }}>
                        <span class="ml-2 text-green-700 font-semibold">Aktif</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="status" value="tidak_aktif" class="status-radio"
                               {{ ($dokter->status ?? 'aktif') == 'tidak_aktif' ? 'checked' : '' }}>
                        <span class="ml-2 text-red-700 font-semibold">Tidak Aktif</span>
                    </label>
                </div>
                
                <div class="flex items-center space-x-2">
                    <div class="flex-1">
                        <span id="statusBadge" class="inline-flex items-center px-3 py-1 rounded-full text-sm
                            {{ ($dokter->status ?? 'aktif') == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <i class="fas fa-circle text-xs mr-1"></i> 
                            {{ ($dokter->status ?? 'aktif') == 'aktif' ? 'Sedang Aktif' : 'Sedang Tidak Aktif' }}
                        </span>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-save mr-2"></i>Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>