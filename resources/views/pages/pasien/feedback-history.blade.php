@extends('layouts.pasien')

@section('title', 'Riwayat Feedback')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Feedback</h1>
            <a href="{{ route('pasien.feedback.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-plus mr-2"></i> Kirim Feedback Baru
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @forelse($feedbacks as $feedback)
            <div class="border-b last:border-0 p-4 hover:bg-gray-50">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $feedback->subjek }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs text-gray-500">{{ $feedback->kategori }}</span>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-500">{{ $feedback->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($feedback->pesan, 100) }}</p>
                        @if($feedback->respon)
                            <div class="mt-2 p-2 bg-green-50 rounded-lg">
                                <p class="text-xs text-green-600 font-semibold">Respon Admin:</p>
                                <p class="text-sm text-gray-700">{{ $feedback->respon }}</p>
                            </div>
                        @endif
                    </div>
                    <div>
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($feedback->status == 'baru') bg-red-100 text-red-700
                            @elseif($feedback->status == 'dibaca') bg-blue-100 text-blue-700
                            @elseif($feedback->status == 'diproses') bg-yellow-100 text-yellow-700
                            @elseif($feedback->status == 'selesai') bg-green-100 text-green-700
                            @endif">
                            {{ $feedback->status }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-2 block"></i>
                <p>Belum ada feedback yang Anda kirim</p>
                <a href="{{ route('pasien.feedback.create') }}" class="text-blue-500 text-sm mt-2 inline-block">Kirim feedback pertama →</a>
            </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $feedbacks->links() }}
        </div>
    </div>
</div>
@endsection