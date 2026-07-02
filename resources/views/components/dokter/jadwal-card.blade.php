@props(['jadwalMingguIni' => []])

@php
/** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Jadwal[] $jadwalMingguIni */
/** @var \App\Models\Jadwal $jadwal */
@endphp

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">Jadwal Praktik Saya</h2>
        <i class="fas fa-calendar-alt text-3xl text-blue-500"></i>
    </div>
    
    @if(session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded text-sm">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="mb-4 p-2 bg-red-100 text-red-700 rounded text-sm">{{ session('error') }}</div>
    @endif
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Tanggal</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Jam</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Kuota</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Sisa</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwalMingguIni as $jadwal)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                    <td class="px-4 py-2">{{ $jadwal->kuota }}</td>
                    <td class="px-4 py-2">{{ $jadwal->sisa_kuota }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            @if($jadwal->status == 'tersedia') bg-green-100 text-green-700
                            @elseif($jadwal->status == 'penuh') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ $jadwal->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <button onclick="editJadwal({{ $jadwal->id }})" 
                                class="text-blue-500 hover:text-blue-700 transition"
                                title="Edit Jadwal">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                        <i class="fas fa-calendar-alt text-3xl mb-2 block text-gray-300"></i>
                        Belum ada jadwal untuk minggu ini.
                        <div class="mt-2">
                            <button onclick="openModalJadwal()" 
                                    class="text-blue-500 hover:text-blue-600 text-sm font-semibold">
                                <i class="fas fa-plus mr-1"></i> Tambah Jadwal
                            </button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($jadwalMingguIni && $jadwalMingguIni->count() > 0)
    <div class="mt-4 pt-3 border-t text-right">
        <button onclick="openModalJadwal()" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
            <i class="fas fa-plus mr-1"></i> Tambah Jadwal
        </button>
    </div>
    @endif
</div>

<script>
function editJadwal(id) {
    // Redirect ke halaman edit jadwal
    window.location.href = '/dokter/jadwal/edit/' + id;
}

// Fungsi untuk membuka modal tambah jadwal (dari component modal-jadwal)
function openModalJadwal() {
    // Cek apakah fungsi openModalJadwal tersedia di global scope
    if (typeof window.openModalJadwal === 'function') {
        window.openModalJadwal();
    } else {
        // Fallback: redirect ke halaman tambah jadwal
        window.location.href = '{{ route("dokter.jadwal.index") }}';
    }
}
</script>