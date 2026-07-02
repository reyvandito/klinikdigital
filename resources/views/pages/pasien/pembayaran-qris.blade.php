@extends('layouts.pasien')

@section('title', 'QRIS - Pembayaran Konsultasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Scan QRIS untuk Bayar</h1>
            <p class="text-gray-500">Gunakan aplikasi e-wallet untuk scan QR Code</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6">
            {{-- QR Code --}}
            <div class="flex justify-center mb-4">
                @if(isset($qrCode) && $qrCode)
                    <img src="{{ $qrCode }}" alt="QRIS" class="w-64 h-64 object-contain">
                @else
                    <div class="w-64 h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                        <i class="fas fa-qrcode text-6xl"></i>
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="text-center space-y-2">
                <p class="text-sm text-gray-500">Jumlah Pembayaran</p>
                <p class="text-2xl font-bold text-gray-800">{{ $pembayaran->jumlah_formatted }}</p>
                <p class="text-sm text-gray-500">Order ID: {{ $pembayaran->order_id }}</p>
                <p class="text-xs text-gray-400">Kadaluarsa: {{ $pembayaran->expired_at ? $pembayaran->expired_at->format('H:i') : '-' }}</p>
            </div>

            {{-- Status --}}
            <div class="mt-4 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                <p class="text-sm text-yellow-700 text-center">
                    <i class="fas fa-clock mr-1"></i>
                    Menunggu pembayaran. Scan QR Code di atas.
                </p>
            </div>

            {{-- Tombol Konfirmasi Manual --}}
            <div class="mt-4 border-t pt-4">
                <p class="text-xs text-gray-400 text-center mb-2">Jika pembayaran sudah selesai, klik tombol di bawah:</p>
                <a href="{{ route('pasien.pembayaran.webhook-manual', $konsultasi->id) }}" 
                   class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold transition block text-center">
                    <i class="fas fa-check-circle mr-2"></i> Konfirmasi Pembayaran (Manual)
                </a>
                <p class="text-xs text-gray-400 text-center mt-2">*Digunakan jika pembayaran sudah dilakukan namun status belum berubah</p>
            </div>

            {{-- Tombol Kembali --}}
            <a href="{{ route('pasien.riwayat') }}" class="mt-3 block text-center text-gray-500 hover:text-gray-700 text-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Riwayat
            </a>
        </div>
    </div>
</div>

<script>
    // Cek status pembayaran setiap 5 detik
    let interval = setInterval(function() {
        fetch('{{ route("pasien.pembayaran.status", $konsultasi->id) }}')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'lunas') {
                    clearInterval(interval);
                    window.location.href = '{{ route("pasien.pembayaran.success", $konsultasi->id) }}';
                }
            })
            .catch(error => console.log('Error checking status:', error));
    }, 5000);
</script>
@endsection