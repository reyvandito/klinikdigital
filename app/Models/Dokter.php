<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $fillable = [
        'user_id',
        'status',
        'spesialis',
        'no_str',
        'foto',
        'tarif', // ← TAMBAHKAN INI
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'dokter_id');
    }

    public function konsultasi(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'dokter_id');
    }

    /**
     * Accessor untuk foto dengan fallback ke default
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('storage/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/default-doctor.png');
    }

    /**
     * Accessor untuk format tarif
     */
    public function getTarifFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->tarif ?? 50000, 0, ',', '.');
    }
}