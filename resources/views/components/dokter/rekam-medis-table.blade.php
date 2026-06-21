@props(['rekamMedis' => []])

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center">
        <h2 class="font-bold text-gray-800">Daftar Rekam Medis</h2>
        <a href="{{ route('dokter.rekam-medis.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
            <i class="fas fa-plus mr-1"></i> Buat Baru
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pasien</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Diagnosa</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($rekamMedis as $index => $rm)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $rekamMedis->firstItem() + $index }}</td>
                    <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 text-sm font-medium">{{ $rm->konsultasi->pasien->user->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm max-w-[200px] truncate">{{ Str::limit($rm->diagnosa, 50) }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('dokter.rekam-medis.show', $rm->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('dokter.rekam-medis.edit') }}?id={{ $rm->id }}" class="text-green-500 hover:text-green-700 mr-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('dokter.rekam-medis.delete', $rm->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Hapus rekam medis ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-folder-open text-4xl mb-2 block"></i>
                        <p>Belum ada rekam medis</p>
                        <a href="{{ route('dokter.rekam-medis.create') }}" class="text-blue-500 text-sm mt-2 inline-block">Buat rekam medis pertama →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t">
        {{ $rekamMedis->links() }}
    </div>
</div>