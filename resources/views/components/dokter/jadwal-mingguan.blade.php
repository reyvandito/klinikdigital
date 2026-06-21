<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50">
        <h2 class="text-lg font-semibold text-gray-800">
            <i class="fas fa-calendar-week mr-2 text-green-500"></i> Jadwal Minggu Ini
        </h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kuota</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Sisa</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($jadwalMingguIni as $jadwal)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 text-sm">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                    <td class="px-4 py-3 text-sm">{{ $jadwal->kuota }}</td>
                    <td class="px-4 py-3 text-sm">{{ $jadwal->sisa_kuota }}</td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            @if($jadwal->status == 'tersedia') bg-green-100 text-green-700
                            @elseif($jadwal->status == 'penuh') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700
                            @endif">
                            {{ $jadwal->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-calendar-week text-4xl mb-2 block"></i>
                        Belum ada jadwal untuk minggu ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>