<?php
 
namespace App\Models;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
 
class User extends Authenticatable
{
    use Notifiable;
 
    protected $fillable = [
        'nama',
        'email',
        'password',
        'nomor_hp',
        'role',
        'jenis_kelamin',
    ];
 
    protected $hidden = [
        'password',
        'remember_token',
    ];
 
    /**
     * Accessor: supaya {{ $user->name }} dan {{ $user->nama }} keduanya bekerja
     * Banyak blade yang pakai $user->name jadi kita buat alias
     */
    public function getNameAttribute(): string
    {
        return $this->nama ?? '';
    }
 
    public function setNameAttribute(string $value): void
    {
        $this->attributes['nama'] = $value;
    }
 
    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class, 'user_id');
    }
 
    public function pasien(): HasOne
    {
        return $this->hasOne(Pasien::class, 'user_id');
    }
}