@props(['riwayatTerbaru' => []])

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b bg-blue-50 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-blue-700">
            <i class="fas fa-history mr-2 text-blue-500"></i> Riwayat Konsultasi Terbaru
        </h2>
        <a href="{{ route('pasien.riwayat') }}" class="text-blue-600 text-sm hover:underline">Lihat Semua →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Dokter</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Keluhan</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($riwayatTerbaru as $riwayat)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm">
                        {{ \Carbon\Carbon::parse($riwayat->jadwal->tanggal)->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 text-sm font-medium">
                        {{ $riwayat->dokter->user->nama ?? '-' }}
                    </td>
                    <td class="px-4 py-2 text-sm max-w-[200px] truncate">
                        {{ Str::limit($riwayat->keluhan, 30) }}
                    </td>
                    <td class="px-4 py-2 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($riwayat->status == 'selesai') bg-green-100 text-green-700
                            @elseif($riwayat->status == 'batal') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700
                            @endif">
                            {{ $riwayat->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-sm">
                        <a href="{{ route('pasien.riwayat.detail', $riwayat->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 block"></i>
                        Belum ada riwayat konsultasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>