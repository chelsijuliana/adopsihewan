<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ChelsiAnimal extends Model
{
    protected $table = 'chelsi_animals';

    protected $fillable = [
        'nama',
        'category_id',
        'jenis',
        'ras',
        'usia',
        'jenis_kelamin',
        'deskripsi',
        'foto',
        'status',
        'user_id',
        'dokter_id'
    ];

    // Relasi ke pengguna yang memberikan hewan (pemberi hibah)
    public function pemberi(): BelongsTo
    {
        return $this->belongsTo(ChelsiUser::class, 'user_id');
    }

    // Relasi ke dokter yang memeriksa hewan
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(ChelsiUser::class, 'dokter_id');
    }

    // Relasi ke banyak rekam medis
    /*public function rekam_medis(): HasMany
    {
        return $this->hasMany(ChelsiMedicalRecord::class, 'hewan_id');
    }*/
    public function rekamMedis(): HasMany
    {
        return $this->hasMany(ChelsiMedicalRecord::class, 'hewan_id');
    }


    // Relasi ke semua permintaan adopsi
    public function adoptionRequests(): HasMany
    {
        return $this->hasMany(ChelsiAdoptionRequest::class, 'hewan_id');
    }

    // Relasi ke galeri foto
    public function galeri(): HasMany
    {
        return $this->hasMany(ChelsiAdoptionGallery::class, 'hewan_id');
    }
    

    public function user(): BelongsTo
    {
        return $this->belongsTo(ChelsiUser::class, 'user_id');
    }

    public function categiry()
{
    return $this->belongsTo(ChelsiCategory::class, 'category_id');
}

}
