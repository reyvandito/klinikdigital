<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50">
        <h2 class="text-lg font-semibold text-gray-800">
            <i class="fas fa-calendar-day mr-2 text-blue-500"></i> Konsultasi Hari Ini
        </h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pasien</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Keluhan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($konsultasiHariIni as $konsultasi)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $konsultasi->pasien->user->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $konsultasi->jadwal->jam_mulai ?? '-' }} - {{ $konsultasi->jadwal->jam_selesai ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">{{ Str::limit($konsultasi->keluhan, 40) }}</td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            @if($konsultasi->status == 'menunggu') bg-yellow-100 text-yellow-700
                            @elseif($konsultasi->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                            @elseif($konsultasi->status == 'berlangsung') bg-green-100 text-green-700
                            @else bg-gray-100 text-gray-700
                            @endif">
                            {{ $konsultasi->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('dokter.pasien.detail', $konsultasi->pasien_id) }}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-calendar-day text-4xl mb-2 block"></i>
                        Tidak ada jadwal konsultasi hari ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>