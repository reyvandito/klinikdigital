<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'kategori',
        'subjek',
        'pesan',
        'status',
        'respon',
        'respon_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk badge status
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'baru' => '<span class="px-2 py-1 rounded-full text-xs bg-red-100 text-red-700">Baru</span>',
            'dibaca' => '<span class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">Dibaca</span>',
            'diproses' => '<span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">Diproses</span>',
            'selesai' => '<span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Selesai</span>',
            default => '<span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">' . $this->status . '</span>',
        };
    }

    // Accessor untuk kategori
    public function getKategoriBadgeAttribute()
    {
        return match ($this->kategori) {
            'umum' => '<span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">Umum</span>',
            'dokter' => '<span class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">Dokter</span>',
            'website' => '<span class="px-2 py-1 rounded-full text-xs bg-purple-100 text-purple-700">Website</span>',
            'reservasi' => '<span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Reservasi</span>',
            'lainnya' => '<span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">Lainnya</span>',
            default => '<span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">' . $this->kategori . '</span>',
        };
    }
}