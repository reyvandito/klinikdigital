<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'user_id',
        'tanggal_lahir',
        'alamat'
    ];

    // ==================== RELATIONS ====================
    
    /**
     * Relasi ke tabel users
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke tabel konsultasi (semua konsultasi pasien)
     */
    public function konsultasi(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'pasien_id');
    }

    /**
     * Relasi ke tabel konsultasi yang aktif (belum selesai)
     */
    public function konsultasiAktif(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'pasien_id')
            ->whereIn('status', ['menunggu', 'dikonfirmasi', 'berlangsung']);
    }

    /**
     * Relasi ke tabel konsultasi yang sudah selesai
     */
    public function konsultasiSelesai(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'pasien_id')
            ->where('status', 'selesai');
    }

    /**
     * Relasi ke rekam medis melalui konsultasi
     */
    public function rekamMedis()
    {
        return $this->hasManyThrough(
            RekamMedis::class,
            Konsultasi::class,
            'pasien_id',  // Foreign key on konsultasi table
            'konsultasi_id', // Foreign key on rekam_medis table
            'id',          // Local key on pasien table
            'id'           // Local key on konsultasi table
        );
    }

    // ==================== ACCESSORS ====================
    
    /**
     * Hitung usia dari tanggal lahir
     */
    public function getUsiaAttribute()
    {
        if ($this->tanggal_lahir) {
            return \Carbon\Carbon::parse($this->tanggal_lahir)->age;
        }
        return '-';
    }

    /**
     * Format tanggal lahir Indonesia
     */
    public function getTanggalLahirFormattedAttribute()
    {
        if ($this->tanggal_lahir) {
            return \Carbon\Carbon::parse($this->tanggal_lahir)->translatedFormat('d F Y');
        }
        return '-';
    }

    /**
     * Format jenis kelamin
     */
    public function getJenisKelaminFormattedAttribute()
    {
        if ($this->user && $this->user->jenis_kelamin) {
            return $this->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
        }
        return '-';
    }

    /**
     * Nama lengkap pasien (ambil dari user)
     */
    public function getNamaAttribute()
    {
        return $this->user->nama ?? '-';
    }

    /**
     * Nomor HP pasien (ambil dari user)
     */
    public function getNomorHpAttribute()
    {
        return $this->user->nomor_hp ?? '-';
    }

    /**
     * Email pasien (ambil dari user)
     */
    public function getEmailAttribute()
    {
        return $this->user->email ?? '-';
    }

    // ==================== SCOPES ====================
    
    /**
     * Scope untuk mencari pasien berdasarkan nama
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->whereHas('user', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    /**
     * Scope untuk pasien yang memiliki konsultasi dengan dokter tertentu
     */
    public function scopeWithDokter($query, $dokterId)
    {
        return $query->whereHas('konsultasi', function ($q) use ($dokterId) {
            $q->where('dokter_id', $dokterId);
        });
    }

    // ==================== METHODS ====================
    
    /**
     * Cek apakah pasien sudah pernah konsultasi dengan dokter tertentu
     */
    public function pernahKonsultasiDengan($dokterId)
    {
        return $this->konsultasi()->where('dokter_id', $dokterId)->exists();
    }

    /**
     * Hitung total konsultasi
     */
    public function totalKonsultasi()
    {
        return $this->konsultasi()->count();
    }

    /**
     * Hitung total konsultasi yang sudah selesai
     */
    public function totalKonsultasiSelesai()
    {
        return $this->konsultasi()->where('status', 'selesai')->count();
    }

    /**
     * Hitung total rekam medis
     */
    public function totalRekamMedis()
    {
        return $this->rekamMedis()->count();
    }
}