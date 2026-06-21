@props(['konsultasis' => []])

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dokter</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Spesialis</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Keluhan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($konsultasis as $index => $konsultasi)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $konsultasis->firstItem() + $index }}</td>
                    <td class="px-4 py-3 text-sm">
                        {{ $konsultasi->jadwal ? \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-4 py-3 text-sm font-medium">
                        {{ $konsultasi->dokter->user->nama ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $konsultasi->dokter->spesialis ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-sm max-w-[150px] truncate" title="{{ $konsultasi->keluhan }}">
                        {{ Str::limit($konsultasi->keluhan, 30) }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($konsultasi->status == 'menunggu') bg-yellow-100 text-yellow-700
                            @elseif($konsultasi->status == 'dikonfirmasi') bg-blue-100 text-blue-700
                            @elseif($konsultasi->status == 'berlangsung') bg-green-100 text-green-700
                            @elseif($konsultasi->status == 'selesai') bg-gray-100 text-gray-700
                            @elseif($konsultasi->status == 'dibatalkan') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700
                            @endif">
                            {{ $konsultasi->status }}
                        </span>
                        @if($konsultasi->rekamMedis)
                            <span class="ml-1 px-1 py-0.5 bg-purple-100 text-purple-700 rounded text-xs">
                                <i class="fas fa-file-medical"></i>
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex space-x-2">
                            <a href="{{ route('pasien.riwayat.detail', $konsultasi->id) }}" 
                               class="text-blue-500 hover:text-blue-700" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(in_array($konsultasi->status, ['menunggu', 'dikonfirmasi']))
                            <a href="{{ route('pasien.reservasi.batal', $konsultasi->id) }}" 
                               class="text-red-500 hover:text-red-700" title="Batalkan"
                               onclick="return confirm('Yakin ingin membatalkan reservasi ini?')">
                                <i class="fas fa-times"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 block"></i>
                        Belum ada riwayat reservasi.
                        <div class="mt-2">
                            <a href="{{ route('pasien.reservasi.create') }}" class="text-blue-500 hover:underline text-sm">
                                Buat janji pertama → 
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t">
        {{ $konsultasis->links() }}
    </div>
</div>