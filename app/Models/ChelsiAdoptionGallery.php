<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChelsiAdoptionGallery extends Model
{
    protected $table = 'chelsi_adoption_galleries';

    protected $fillable = [
        'hewan_id', 'adopter_id', 'foto', 'deskripsi'
    ];

    public function hewan(): BelongsTo
    {
        return $this->belongsTo(ChelsiAnimal::class, 'hewan_id');
    }

    public function adopter(): BelongsTo
    {
        return $this->belongsTo(ChelsiUser::class, 'adopter_id');
    }
    
}
