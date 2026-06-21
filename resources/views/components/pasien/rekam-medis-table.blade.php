@props(['rekamMedis' => []])

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Dokter</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Diagnosa</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Tindakan</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($rekamMedis as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 text-sm">{{ $rekamMedis->firstItem() + $index }}</td>
                    <td class="px-5 py-3 text-sm">
                        {{ $item->konsultasi->jadwal ? \Carbon\Carbon::parse($item->konsultasi->jadwal->tanggal)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-5 py-3 text-sm font-medium">
                        {{ $item->konsultasi->dokter->user->nama ?? '-' }}
                    </td>
                    <td class="px-5 py-3 text-sm max-w-[150px] truncate" title="{{ $item->diagnosa }}">
                        {{ Str::limit($item->diagnosa, 30) }}
                    </td>
                    <td class="px-5 py-3 text-sm max-w-[150px] truncate" title="{{ $item->tindakan }}">
                        {{ Str::limit($item->tindakan ?? '-', 30) }}
                    </td>
                    <td class="px-5 py-3">
                        <a href="{{ route('pasien.rekam-medis.detail', $item->id) }}" 
                           class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-8 text-center text-gray-500">
                        <i class="fas fa-folder-open text-4xl mb-2 block"></i>
                        <p>Belum ada rekam medis</p>
                        <p class="text-xs text-gray-400 mt-1">Rekam medis akan muncul setelah Anda melakukan konsultasi dengan dokter.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-3 border-t">
        {{ $rekamMedis->links() }}
    </div>
</div>