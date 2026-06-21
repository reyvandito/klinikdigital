@extends('layouts.dokter')

@section('title', 'Detail Feedback')
@section('page-title', 'Detail Feedback')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">
            <i class="fas fa-comment-dots text-blue-500 mr-2"></i> Detail Feedback
        </h2>
        <a href="{{ route('dokter.feedback.index') }}" class="text-blue-500 hover:text-blue-700">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
                <i class="fas fa-user text-blue-500 mr-2"></i> Pengirim
            </h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-500">Nama</span>
                    <span class="font-medium">{{ $feedback->nama }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Email</span>
                    <span class="font-medium">{{ $feedback->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Kategori</span>
                    <span class="px-2 py-1 rounded-full text-xs
                        @if($feedback->kategori == 'umum') bg-gray-100 text-gray-700
                        @elseif($feedback->kategori == 'dokter') bg-blue-100 text-blue-700
                        @elseif($feedback->kategori == 'website') bg-purple-100 text-purple-700
                        @elseif($feedback->kategori == 'reservasi') bg-green-100 text-green-700
                        @else bg-yellow-100 text-yellow-700 @endif">
                        {{ ucfirst($feedback->kategori) }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>
                    <span class="px-2 py-1 rounded-full text-xs
                        @if($feedback->status == 'baru') bg-red-100 text-red-700
                        @elseif($feedback->status == 'dibaca') bg-blue-100 text-blue-700
                        @elseif($feedback->status == 'diproses') bg-yellow-100 text-yellow-700
                        @elseif($feedback->status == 'selesai') bg-green-100 text-green-700 @endif">
                        {{ $feedback->status }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Dikirim</span>
                    <span class="font-medium">{{ $feedback->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
                <i class="fas fa-info-circle text-yellow-500 mr-2"></i> Detail
            </h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Subjek</p>
                    <p class="font-medium">{{ $feedback->subjek }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pesan</p>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $feedback->pesan }}</p>
                </div>
                @if($feedback->respon)
                <div>
                    <p class="text-sm text-gray-500">Respon</p>
                    <p class="text-gray-700 bg-green-50 p-3 rounded-lg">{{ $feedback->respon }}</p>
                    <p class="text-xs text-gray-400 mt-1">Direspon: {{ $feedback->respon_at ? $feedback->respon_at->format('d/m/Y H:i') : '-' }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Update Status --}}
    <div class="border rounded-lg p-4 mt-4">
        <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
            <i class="fas fa-edit text-yellow-500 mr-2"></i> Update Status
        </h3>
        <form action="{{ route('dokter.feedback.update-status', $feedback->id) }}" method="POST" class="flex gap-2">
            @csrf
            <select name="status" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <option value="baru" {{ $feedback->status == 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="dibaca" {{ $feedback->status == 'dibaca' ? 'selected' : '' }}>Dibaca</option>
                <option value="diproses" {{ $feedback->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ $feedback->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                <i class="fas fa-save mr-1"></i> Update
            </button>
        </form>
    </div>
</div>
@endsection