<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = [
        'dokter_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
        'sisa_kuota',  // ← WAJIB ada
        'status',      // ← WAJIB ada: tersedia | penuh | tutup
    ];

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function konsultasi(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'jadwal_id');
    }
}