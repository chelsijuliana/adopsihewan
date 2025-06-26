<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChelsiUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'chelsi_users';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address', 'photo'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi: Pemberi memiliki banyak hewan
    public function hewanDiberikan(): HasMany
    {
        return $this->hasMany(ChelsiAnimal::class, 'user_id');
    }

    // Relasi: Dokter memeriksa banyak hewan
    public function hewanDiperiksa(): HasMany
    {
        return $this->hasMany(ChelsiAnimal::class, 'dokter_id');
    }

    // Relasi: Dokter punya banyak rekam medis
    public function rekamMedis(): HasMany
    {
        return $this->hasMany(ChelsiMedicalRecord::class, 'dokter_id');
    }

    // Relasi: Adopter mengajukan banyak permintaan adopsi
    public function permintaanAdopsi(): HasMany
    {
        return $this->hasMany(ChelsiAdoptionRequest::class, 'adopter_id');
    }

    // Relasi: Adopter punya galeri adopsi
    public function galeriAdopsi(): HasMany
    {
        return $this->hasMany(ChelsiAdoptionGallery::class, 'adopter_id');
    }

    // Relasi: User yang membuat artikel
    public function artikel(): HasMany
    {
        return $this->hasMany(ChelsiArticle::class, 'created_by');
    }
}
