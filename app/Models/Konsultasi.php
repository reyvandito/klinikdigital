<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';

    protected $fillable = [
        'jadwal_id',
        'dokter_id',
        'pasien_id',
        'keluhan',
        'status'
    ];

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function rekamMedis(): HasOne
    {
        return $this->hasOne(RekamMedis::class, 'konsultasi_id');
    }

    // Relasi ke pembayaran
    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'konsultasi_id');
    }

    // Cek apakah sudah bayar
    public function getIsPaidAttribute()
    {
        return $this->pembayaran && $this->pembayaran->status == 'lunas';
    }
}