@props(['dokterPending' => []])

<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">
            <i class="fas fa-clock text-orange-500 mr-2"></i>
            Dokter Menunggu Verifikasi
        </h2>
        <a href="{{ route('admin.dokter.index') }}" class="text-blue-500 hover:text-blue-600 text-sm">Lihat semua →</a>
    </div>
    
    @forelse($dokterPending as $dokter)
    <div class="flex items-center justify-between border rounded-lg p-4 mb-3 last:mb-0 bg-yellow-50">
        <div>
            <p class="font-semibold text-gray-800">{{ $dokter->user->nama ?? '-' }}</p>
            <p class="text-sm text-gray-600">{{ $dokter->spesialis }} | {{ $dokter->user->email ?? '-' }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.dokter.verify', $dokter->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm">
                <i class="fas fa-check mr-1"></i> Verifikasi
            </a>
            <a href="{{ route('admin.dokter.reject', $dokter->id) }}" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                <i class="fas fa-times mr-1"></i> Tolak
            </a>
        </div>
    </div>
    @empty
    <div class="text-center py-6 text-gray-500">
        <i class="fas fa-check-circle text-4xl mb-2 text-green-500"></i>
        <p>Semua dokter sudah terverifikasi</p>
    </div>
    @endforelse
</div>