<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'konsultasi_id',
        'order_id',
        'metode',
        'jumlah',
        'status',
        'snap_token',
        'payment_url',
        'qr_code',
        'expired_at',
        'paid_at',
        'response'
    ];

    protected $casts = [
        'response' => 'array',
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function konsultasi(): BelongsTo
    {
        return $this->belongsTo(Konsultasi::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending' => '<span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">Menunggu Bayar</span>',
            'lunas' => '<span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Lunas</span>',
            'gagal' => '<span class="px-2 py-1 rounded-full text-xs bg-red-100 text-red-700">Gagal</span>',
            'expired' => '<span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">Kadaluarsa</span>',
            default => '<span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">' . $this->status . '</span>',
        };
    }

    public function getJumlahFormattedAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }
}