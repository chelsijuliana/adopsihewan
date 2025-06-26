<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChelsiAnimal extends Model
{
    protected $table = 'chelsi_animals';

    protected $fillable = [
        'nama', 'jenis', 'ras', 'usia', 'jenis_kelamin',
        'deskripsi', 'foto', 'status', 'user_id', 'dokter_id'
    ];

    // Relasi: milik pemberi
    public function pemberi(): BelongsTo
    {
        return $this->belongsTo(ChelsiUser::class, 'user_id');
    }

    // Relasi: diperiksa oleh dokter
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(ChelsiUser::class, 'dokter_id');
    }

    // Relasi: memiliki banyak rekam medis
    public function rekamMedis(): HasMany
    {
        return $this->hasMany(ChelsiMedicalRecord::class, 'hewan_id');
    }

    // Relasi: memiliki banyak permintaan adopsi
    public function permintaanAdopsi(): HasMany
    {
        return $this->hasMany(ChelsiAdoptionRequest::class, 'hewan_id');
    }

    // Relasi: memiliki galeri
    public function galeri(): HasMany
    {
        return $this->hasMany(ChelsiAdoptionGallery::class, 'hewan_id');
    }
}
