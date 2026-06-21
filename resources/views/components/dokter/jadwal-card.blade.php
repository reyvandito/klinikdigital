<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">Jadwal Praktik Saya</h2>
        <i class="fas fa-calendar-alt text-3xl text-blue-500"></i>
    </div>
    
    @if(session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded text-sm">{{ session('success') }}</div>
    @endif
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Jam</th>
                    <th class="px-4 py-2 text-left">Kuota</th>
                    <th class="px-4 py-2 text-left">Sisa</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody id="jadwalTableBody">
                @forelse($jadwalMingguIni ?? [] as $jadwal)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                    <td class="px-4 py-2">{{ $jadwal->kuota }}</td>
                    <td class="px-4 py-2">{{ $jadwal->sisa_kuota }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($jadwal->status == 'tersedia') bg-green-100 text-green-700
                            @elseif($jadwal->status == 'penuh') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ $jadwal->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <button onclick="editJadwal({{ $jadwal->id }})" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada jadwal</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function editJadwal(id) {
    window.location.href = '/dokter/jadwal/edit/' + id;
}
</script>