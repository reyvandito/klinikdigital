@props(['konsultasiTerbaru' => []])

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Aktivitas Terbaru (Konsultasi) -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">
            <i class="fas fa-bolt text-yellow-500 mr-2"></i> Konsultasi Terbaru
        </h2>
        <div class="space-y-3">
            @forelse($konsultasiTerbaru as $konsultasi)
            <div class="flex items-center justify-between border-b pb-3 last:border-0">
                <div>
                    <p class="font-semibold">{{ $konsultasi->pasien->user->nama ?? '-' }}</p>
                    <p class="text-sm text-gray-500">Dokter: {{ $konsultasi->dokter->user->nama ?? '-' }}</p>
                    <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($konsultasi->created_at)->diffForHumans() }}</p>
                </div>
                <div>
                    <span class="px-2 py-1 rounded-full text-xs
                        @if($konsultasi->status == 'menunggu') bg-yellow-100 text-yellow-700
                        @elseif($konsultasi->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                        @elseif($konsultasi->status == 'berlangsung') bg-green-100 text-green-700
                        @elseif($konsultasi->status == 'selesai') bg-gray-100 text-gray-700
                        @else bg-red-100 text-red-700
                        @endif">
                        {{ $konsultasi->status }}
                    </span>
                </div>
            </div>
            @empty
            <div class="text-center py-6 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-2 block"></i>
                <p>Belum ada konsultasi</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">
            <i class="fas fa-calendar-day text-blue-500 mr-2"></i> Jadwal Hari Ini
        </h2>
        <div class="space-y-3">
            @php
                $jadwalHariIni = App\Models\Jadwal::with('dokter.user')
                    ->whereDate('tanggal', today())
                    ->orderBy('jam_mulai')
                    ->take(5)
                    ->get();
            @endphp
            
            @forelse($jadwalHariIni as $jadwal)
            <div class="flex items-center justify-between border-b pb-3 last:border-0">
                <div>
                    <p class="font-semibold">{{ $jadwal->dokter->user->nama ?? '-' }}</p>
                    <p class="text-sm text-gray-500">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                </div>
                <div class="text-right">
                    <span class="text-sm text-gray-600">Kuota: {{ $jadwal->sisa_kuota }}/{{ $jadwal->kuota }}</span>
                    <span class="px-2 py-1 rounded-full text-xs block mt-1
                        @if($jadwal->status == 'tersedia') bg-green-100 text-green-700
                        @elseif($jadwal->status == 'penuh') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700
                        @endif">
                        {{ $jadwal->status }}
                    </span>
                </div>
            </div>
            @empty
            <div class="text-center py-6 text-gray-500">
                <i class="fas fa-calendar-times text-4xl mb-2 block"></i>
                <p>Tidak ada jadwal hari ini</p>
            </div>
            @endforelse
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.jadwal.index') }}" class="text-blue-500 hover:text-blue-600 text-sm">Lihat semua jadwal →</a>
        </div>
    </div>
</div>