@extends('layouts.pasien')

@section('title', 'Pembayaran Konsultasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <div class="inline-block p-4 bg-yellow-50 rounded-full mb-4">
                <i class="fas fa-credit-card text-4xl text-yellow-500"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Pembayaran Konsultasi</h1>
            <p class="text-gray-500">Selesaikan pembayaran untuk melanjutkan konsultasi</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            {{-- Info Konsultasi --}}
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="font-semibold text-gray-700">Detail Konsultasi</h2>
            </div>
            <div class="px-6 py-4 grid grid-cols-2 gap-3 text-sm">
                <div>
                    <p class="text-gray-500">Dokter</p>
                    <p class="font-semibold">{{ $konsultasi->dokter->user->nama }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Spesialis</p>
                    <p class="font-semibold">{{ $konsultasi->dokter->spesialis }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tanggal</p>
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($konsultasi->jadwal->tanggal)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Jam</p>
                    <p class="font-semibold">{{ $konsultasi->jadwal->jam_mulai }} - {{ $konsultasi->jadwal->jam_selesai }}</p>
                </div>
            </div>

            {{-- Detail Pembayaran --}}
            <div class="bg-gray-50 px-6 py-4 border-t border-b">
                <h2 class="font-semibold text-gray-700">Detail Pembayaran</h2>
            </div>
            <div class="px-6 py-4">
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-500">Biaya Konsultasi</span>
                    <span class="font-semibold">{{ $pembayaran->jumlah_formatted }}</span>
                </div>
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-500">Metode Pembayaran</span>
                    <span class="font-semibold uppercase">{{ $pembayaran->metode }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Status</span>
                    <span>{!! $pembayaran->status_badge !!}</span>
                </div>
            </div>

            {{-- Tombol Bayar --}}
            <div class="px-6 py-4 border-t bg-gray-50">
                @if($pembayaran->status == 'pending' && isset($snapToken))
                    <button id="pay-button" 
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-semibold transition">
                        <i class="fas fa-qrcode mr-2"></i> Bayar Sekarang (QRIS)
                    </button>
                    <p class="text-xs text-gray-400 mt-2 text-center">Pembayaran akan dikonfirmasi otomatis</p>

                    {{-- TOMBOL KONFIRMASI MANUAL --}}
                    <div class="mt-4 border-t pt-4">
                        <p class="text-xs text-gray-400 text-center mb-2">Jika pembayaran sudah selesai, klik tombol di bawah:</p>
                        <a href="{{ route('pasien.pembayaran.webhook-manual', $konsultasi->id) }}" 
                           class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold transition block text-center">
                            <i class="fas fa-check-circle mr-2"></i> Konfirmasi Pembayaran (Manual)
                        </a>
                        <p class="text-xs text-gray-400 text-center mt-2">*Digunakan jika pembayaran sudah dilakukan namun status belum berubah</p>
                    </div>
                @elseif($pembayaran->status == 'lunas')
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle text-4xl text-green-500 mb-2 block"></i>
                        <p class="font-semibold text-green-600">Pembayaran Lunas!</p>
                        <a href="{{ route('pasien.riwayat.detail', $konsultasi->id) }}" 
                           class="text-blue-500 text-sm hover:underline">Lihat Detail</a>
                    </div>
                @elseif($pembayaran->status == 'pending' && !isset($snapToken))
                    <a href="{{ route('pasien.pembayaran.simulate', $konsultasi->id) }}" 
                       class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-semibold transition block text-center">
                        <i class="fas fa-qrcode mr-2"></i> Bayar Sekarang (Demo QRIS)
                    </a>
                    <p class="text-xs text-gray-400 mt-2 text-center">*Mode demo, pembayaran langsung berhasil</p>
                @else
                    <div class="text-center py-4 text-red-500">
                        <i class="fas fa-exclamation-circle text-4xl mb-2 block"></i>
                        <p>Pembayaran gagal atau kadaluarsa.</p>
                        <a href="{{ route('pasien.reservasi.create') }}" 
                           class="text-blue-500 text-sm hover:underline">Coba Reservasi Ulang</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-6 text-center">
            <a href="{{ route('pasien.riwayat') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Riwayat
            </a>
        </div>
    </div>
</div>

{{-- Midtrans Snap Script --}}
@if(isset($snapToken) && $pembayaran->status == 'pending')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') ?? 'Mid-client-I4fI5ehjroP7FLbs' }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = "{{ route('pasien.pembayaran.success', $konsultasi->id) }}";
            },
            onPending: function(result) {
                alert('Pembayaran pending, silakan selesaikan pembayaran.');
            },
            onError: function(result) {
                alert('Terjadi kesalahan: ' + result.status_message);
            },
            onClose: function() {
                console.log('Popup ditutup');
            }
        });
    });
</script>
@endif
@endsection