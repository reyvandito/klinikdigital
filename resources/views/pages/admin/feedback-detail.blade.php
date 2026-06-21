@extends('layouts.admin')

@section('title', 'Detail Feedback')
@section('page-title', 'Detail Feedback')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">
            <i class="fas fa-comment-dots text-blue-500 mr-2"></i> Detail Feedback
        </h2>
        <a href="{{ route('admin.feedback.index') }}" class="text-blue-500 hover:text-blue-700">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

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
                    <span>{!! $feedback->kategori_badge !!}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>
                    <span>{!! $feedback->status_badge !!}</span>
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
            </div>
        </div>
    </div>

    {{-- Update Status --}}
    <div class="border rounded-lg p-4 mt-4">
        <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
            <i class="fas fa-edit text-yellow-500 mr-2"></i> Update Status
        </h3>
        <form action="{{ route('admin.feedback.update-status', $feedback->id) }}" method="POST" class="flex gap-2">
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

    {{-- Kirim Respon --}}
    <div class="border rounded-lg p-4 mt-4 border-green-200 bg-green-50">
        <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">
            <i class="fas fa-reply text-green-500 mr-2"></i> Kirim Respon
        </h3>
        <form action="{{ route('admin.feedback.response', $feedback->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="respon" rows="4" 
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                          placeholder="Tulis respon untuk pengirim...">{{ old('respon', $feedback->respon) }}</textarea>
                @error('respon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                <i class="fas fa-paper-plane mr-2"></i> Kirim Respon
            </button>
        </form>
        @if($feedback->respon)
            <div class="mt-3 p-3 bg-white rounded-lg border border-green-200">
                <p class="text-sm text-gray-500">Respon dikirim: {{ $feedback->respon_at ? $feedback->respon_at->format('d/m/Y H:i') : '-' }}</p>
                <p class="text-gray-700 mt-1">{{ $feedback->respon }}</p>
            </div>
        @endif
    </div>
</div>
@endsection