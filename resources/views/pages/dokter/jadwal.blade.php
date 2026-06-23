@extends('layouts.dokter')

@section('title', 'Kelola Jadwal Praktik')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-calendar-alt mr-2 text-blue-500"></i> Kelola Jadwal Praktik
            </h2>
            <button onclick="openModalJadwal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Jadwal
            </button>
        </div>

        @if(session('success'))
            <div class="m-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="m-4 p-3 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jam Mulai</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jam Selesai</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kuota</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Sisa</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($jadwals as $jadwal)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm">{{ $jadwal->jam_mulai }}</td>
                        <td class="px-4 py-3 text-sm">{{ $jadwal->jam_selesai }}</td>
                        <td class="px-4 py-3 text-sm">{{ $jadwal->kuota }}</td>
                        <td class="px-4 py-3 text-sm">{{ $jadwal->sisa_kuota }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs
                                @if($jadwal->status == 'tersedia') bg-green-100 text-green-700
                                @elseif($jadwal->status == 'penuh') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ $jadwal->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <form action="{{ route('dokter.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-calendar-alt text-4xl mb-2 block"></i>
                            Belum ada jadwal. Silakan tambah jadwal baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t">
            {{ $jadwals->links() }}
        </div>
    </div>
</div>

{{-- Panggil component modal (modalnya di component) --}}
<x-dokter.modal-jadwal />

<script>
function openModalJadwal() {
    const modal = document.getElementById('modalJadwal');
    if (modal) {
        modal.classList.remove('hidden');
    }
}
</script>
@endsection