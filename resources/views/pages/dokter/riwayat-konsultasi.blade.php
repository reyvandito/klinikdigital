@extends('layouts.dokter')

@section('title', 'Riwayat Konsultasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Riwayat Konsultasi</h1>
        <a href="{{ route('dokter.dashboard') }}"
           class="text-blue-600 hover:text-blue-800 flex items-center gap-1 text-sm">
            <i class="fas fa-arrow-left"></i> Dashboard
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        @if($konsultasis->count() > 0)
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 text-left">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Pasien</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Jam</th>
                    <th class="px-4 py-3">Rekam Medis</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($konsultasis as $k)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 font-medium">{{ $k->pasien->user->nama }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($k->jadwal->tanggal)->format('d M Y') }}</td>
                    <td class="px-4 py-3">{{ $k->jadwal->jam_mulai }}</td>
                    <td class="px-4 py-3">
                        @if($k->rekamMedis)
                            <span class="text-green-600 text-xs"><i class="fas fa-check mr-1"></i>Ada</span>
                        @else
                            <span class="text-gray-400 text-xs">Belum diisi</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('dokter.konsultasi.detail', $k->id) }}"
                           class="text-blue-600 hover:underline text-xs">Detail</a>
                        @if(!$k->rekamMedis)
                        | <a href="{{ route('dokter.rekam-medis.create', ['konsultasi_id' => $k->id]) }}"
                             class="text-green-600 hover:underline text-xs">Isi Rekam Medis</a>
                        @else
                        | <a href="{{ route('dokter.rekam-medis.show', $k->rekamMedis->id) }}"
                             class="text-purple-600 hover:underline text-xs">Lihat RM</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-4 py-3">
            {{ $konsultasis->links() }}
        </div>
        @else
        <div class="text-center py-12 text-gray-400">
            <i class="fas fa-history text-4xl mb-3 block"></i>
            <p>Belum ada riwayat konsultasi.</p>
        </div>
        @endif
    </div>
</div>
@endsection