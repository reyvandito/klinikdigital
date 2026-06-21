@props(['dokters' => []])

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50">
        <h2 class="text-lg font-semibold text-gray-800">
            <i class="fas fa-star mr-2 text-yellow-500"></i> Rekomendasi Dokter
        </h2>
    </div>
    <div class="p-4 space-y-3">
        @forelse($dokters as $dokter)
        <div class="flex items-center justify-between border-b last:border-0 pb-3 mb-3 last:pb-0">
            <div class="flex items-center gap-3">
                <img src="{{ $dokter->foto_url }}" alt="{{ $dokter->user->nama }}" class="w-12 h-12 rounded-full object-cover">
                <div>
                    <p class="font-semibold text-gray-800">{{ $dokter->user->nama }}</p>
                    <p class="text-sm text-gray-500">{{ $dokter->spesialis }}</p>
                </div>
            </div>
            <a href="{{ route('pasien.reservasi.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                <i class="fas fa-calendar-plus mr-1"></i> Buat Janji
            </a>
        </div>
        @empty
        <div class="text-center py-6 text-gray-500">
            <i class="fas fa-user-md text-4xl mb-2 block"></i>
            <p>Belum ada data dokter</p>
        </div>
        @endforelse
    </div>
</div>