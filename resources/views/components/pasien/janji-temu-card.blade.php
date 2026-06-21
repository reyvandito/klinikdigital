@props(['janjiTemu' => []])

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b bg-blue-50">
        <h2 class="text-lg font-semibold text-blue-700">
            <i class="fas fa-calendar-check mr-2 text-blue-500"></i> Janji Temu Mendatang
        </h2>
    </div>
    <div class="p-4">
        @forelse($janjiTemu as $janji)
        <div class="border-b last:border-0 pb-3 mb-3 last:pb-0">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-semibold text-gray-800">{{ $janji->dokter->user->nama ?? '-' }}</p>
                    <p class="text-sm text-gray-500">{{ $janji->dokter->spesialis ?? '-' }}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-xs text-gray-500">
                            <i class="fas fa-calendar-alt mr-1"></i> 
                            {{ \Carbon\Carbon::parse($janji->jadwal->tanggal)->format('d/m/Y') }}
                        </span>
                        <span class="text-xs text-gray-500">
                            <i class="fas fa-clock mr-1"></i> 
                            {{ $janji->jadwal->jam_mulai ?? '-' }} - {{ $janji->jadwal->jam_selesai ?? '-' }}
                        </span>
                    </div>
                </div>
                <div>
                    <span class="px-2 py-1 rounded-full text-xs
                        @if($janji->status == 'menunggu') bg-yellow-100 text-yellow-700
                        @elseif($janji->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                        @elseif($janji->status == 'berlangsung') bg-green-100 text-green-700
                        @else bg-gray-100 text-gray-700
                        @endif">
                        {{ $janji->status }}
                    </span>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-1">Keluhan: {{ Str::limit($janji->keluhan, 50) }}</p>
        </div>
        @empty
        <div class="text-center py-6 text-gray-500">
            <i class="fas fa-calendar-times text-4xl mb-2 block"></i>
            <p>Belum ada janji temu mendatang</p>
            <a href="{{ route('pasien.reservasi.create') }}" class="text-blue-500 text-sm mt-2 inline-block">Buat janji sekarang →</a>
        </div>
        @endforelse
    </div>
</div>