@extends('layouts.pasien')

@section('title', 'Riwayat Reservasi - Klinik Digital')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Riwayat Reservasi</h1>
        <p class="text-gray-600">Daftar janji temu Anda dengan dokter</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if(count($reservasis) > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($reservasis as $reservasi)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $reservasi['dokter_nama'] }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $reservasi['tanggal'] }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $reservasi['jam'] }}</td>
                            <td class="px-6 py-4">
                                @if($reservasi['status'] == 'menunggu')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Menunggu</span>
                                @elseif($reservasi['status'] == 'selesai')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Selesai</span>
                                @elseif($reservasi['status'] == 'batal')
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Batal</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button class="text-blue-500 hover:text-blue-700 mr-2">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if($reservasi['status'] == 'menunggu')
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-calendar-times text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-500">Belum ada reservasi</p>
                <a href="{{ route('pasien.reservasi.create') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Buat Reservasi Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
@endsection