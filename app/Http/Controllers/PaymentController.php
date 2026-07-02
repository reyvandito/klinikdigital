<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Setup Midtrans
        Config::$serverKey = 'Mid-server-aht5cU8rbsW5XvIrrIUSDyi2';
        Config::$clientKey = 'Mid-client-I4fI5ehjroP7FLbs';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // ==================== HALAMAN PEMBAYARAN ====================
    public function index($konsultasiId)
    {
        $konsultasi = Konsultasi::with(['dokter.user', 'jadwal', 'pembayaran'])
            ->where('id', $konsultasiId)
            ->where('pasien_id', Auth::user()->pasien->id)
            ->firstOrFail();

        $pembayaran = $konsultasi->pembayaran;

        if (!$pembayaran) {
            return redirect()->route('pasien.riwayat')->with('error', 'Pembayaran tidak ditemukan.');
        }

        // Jika sudah lunas, langsung ke halaman sukses
        if ($pembayaran->status == 'lunas') {
            return redirect()->route('pasien.pembayaran.success', $konsultasiId);
        }

        // Generate Snap Token dari Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $pembayaran->order_id,
                'gross_amount' => (int) $pembayaran->jumlah,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->nama,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->nomor_hp ?? '08123456789',
            ],
            'item_details' => [
                [
                    'id' => 'KONSULTASI-' . $konsultasiId,
                    'price' => (int) $pembayaran->jumlah,
                    'quantity' => 1,
                    'name' => 'Konsultasi dengan ' . $konsultasi->dokter->user->nama,
                ]
            ],
            'enabled_payments' => ['qris', 'gopay', 'bank_transfer'],
            'callbacks' => [
                'finish' => route('pasien.pembayaran.success', $konsultasiId),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $pembayaran->update(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }

        return view('pages.pasien.pembayaran', compact('konsultasi', 'pembayaran', 'snapToken'));
    }

    // ==================== NOTIFIKASI WEBHOOK ====================
    public function webhook(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Webhook:', $payload);

        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$orderId) {
            return response()->json(['status' => 'error'], 400);
        }

        $pembayaran = Pembayaran::where('order_id', $orderId)->first();

        if (!$pembayaran) {
            return response()->json(['status' => 'not_found'], 404);
        }

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            if ($fraudStatus == 'accept') {
                $pembayaran->update([
                    'status' => 'lunas',
                    'paid_at' => now(),
                    'response' => $payload,
                ]);
                $pembayaran->konsultasi->update(['status' => 'dikonfirmasi']);
            }
        } elseif ($transactionStatus == 'pending') {
            $pembayaran->update(['status' => 'pending', 'response' => $payload]);
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            $pembayaran->update(['status' => 'gagal', 'response' => $payload]);
        }

        return response()->json(['status' => 'ok']);
    }

    // ==================== WEBHOOK MANUAL (KONFIRMASI) ====================
    public function webhookManual($konsultasiId)
    {
        $pembayaran = Pembayaran::where('konsultasi_id', $konsultasiId)->firstOrFail();

        if ($pembayaran->status == 'pending') {
            $pembayaran->update([
                'status' => 'lunas',
                'paid_at' => now(),
            ]);
            $pembayaran->konsultasi->update(['status' => 'dikonfirmasi']);
        }

        return redirect()->route('pasien.pembayaran.success', $konsultasiId)
            ->with('success', '✅ Pembayaran berhasil dikonfirmasi!');
    }

    // ==================== HALAMAN SUKSES ====================
    public function success($konsultasiId)
    {
        $konsultasi = Konsultasi::with(['dokter.user', 'jadwal', 'pembayaran'])
            ->where('id', $konsultasiId)
            ->where('pasien_id', Auth::user()->pasien->id)
            ->firstOrFail();

        $pembayaran = $konsultasi->pembayaran;

        return view('pages.pasien.pembayaran-success', compact('konsultasi', 'pembayaran'));
    }

    // ==================== STATUS PEMBAYARAN ====================
    public function status($konsultasiId)
    {
        $pembayaran = Pembayaran::where('konsultasi_id', $konsultasiId)->first();

        if (!$pembayaran) {
            return response()->json(['status' => 'not_found'], 404);
        }

        return response()->json([
            'status' => $pembayaran->status,
            'order_id' => $pembayaran->order_id,
            'paid_at' => $pembayaran->paid_at,
        ]);
    }

    // ==================== SIMULASI ====================
    public function simulate($konsultasiId)
    {
        $pembayaran = Pembayaran::where('konsultasi_id', $konsultasiId)->firstOrFail();

        if ($pembayaran->status == 'pending') {
            $pembayaran->update([
                'status' => 'lunas',
                'paid_at' => now(),
            ]);
            $pembayaran->konsultasi->update(['status' => 'dikonfirmasi']);
        }

        return redirect()->route('pasien.pembayaran.success', $konsultasiId)
            ->with('success', 'Pembayaran berhasil!');
    }

// ==================== QRIS CORE API (HALAMAN QRIS) ====================
public function qris($konsultasiId)
{
    $konsultasi = Konsultasi::with(['dokter.user', 'jadwal', 'pembayaran'])
        ->where('id', $konsultasiId)
        ->where('pasien_id', Auth::user()->pasien->id)
        ->firstOrFail();

    $pembayaran = $konsultasi->pembayaran;

    if (!$pembayaran) {
        return redirect()->route('pasien.riwayat')->with('error', 'Pembayaran tidak ditemukan.');
    }

    if ($pembayaran->status == 'lunas') {
        return redirect()->route('pasien.pembayaran.success', $konsultasiId);
    }

    // Generate QRIS via Core API
    $params = [
        'payment_type' => 'qris',
        'transaction_details' => [
            'order_id' => $pembayaran->order_id,
            'gross_amount' => (int) $pembayaran->jumlah,
        ],
        'customer_details' => [
            'first_name' => Auth::user()->nama,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->nomor_hp ?? '08123456789',
        ],
        'qris' => [
            'acquirer' => 'gopay',
        ],
    ];

    try {
        $response = \Midtrans\CoreApi::charge($params);
        $qrCode = $response->qr_code ?? null;

        if ($qrCode) {
            return view('pages.pasien.pembayaran-qris', compact('konsultasi', 'pembayaran', 'qrCode'));
        }

        return back()->with('error', 'Gagal generate QR Code.');
    } catch (\Exception $e) {
        Log::error('QRIS Error: ' . $e->getMessage());
        return back()->with('error', 'Gagal memproses pembayaran QRIS: ' . $e->getMessage());
    }
}
}