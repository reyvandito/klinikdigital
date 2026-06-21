<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">Daftar Pasien Konsultasi</h2>
        <a href="{{ route('dokter.pasien.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
            <i class="fas fa-list mr-1"></i> Lihat Semua
        </a>
    </div>
    
    <div class="space-y-4" id="daftarPasien">
        @forelse($konsultasiHariIni ?? [] as $konsultasi)
        <div class="border rounded-lg p-4 hover:shadow-lg transition">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">
                            {{ \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') }} - {{ $konsultasi->jadwal->jam_mulai }}
                        </span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $konsultasi->pasien->user->nama ?? '-' }}</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-700"><strong>Keluhan:</strong> {{ Str::limit($konsultasi->keluhan, 50) }}</p>
                    </div>
                    <div class="mt-3">
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($konsultasi->status == 'menunggu') bg-yellow-100 text-yellow-700
                            @elseif($konsultasi->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                            @elseif($konsultasi->status == 'berlangsung') bg-green-100 text-green-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ $konsultasi->status }}
                        </span>
                    </div>
                </div>
                <div class="flex flex-col space-y-2">
                    @if($konsultasi->status == 'menunggu' || $konsultasi->status == 'dikonfirmasi')
                    <form action="{{ route('dokter.konsultasi.mulai', $konsultasi->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg w-full">
                            <i class="fas fa-play mr-1"></i> Mulai
                        </button>
                    </form>
                    @endif
                    <button onclick="openModalDetailPasien({{ $konsultasi->pasien_id }})" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-eye mr-1"></i> Detail
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8 text-gray-500">
            <i class="fas fa-inbox text-4xl mb-2 block"></i>
            <p>Belum ada pasien yang konsultasi hari ini</p>
        </div>
        @endforelse
    </div>
</div>