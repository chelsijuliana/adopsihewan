<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChelsiMedicalRecord extends Model
{
    protected $table = 'chelsi_medical_records';

    protected $fillable = [
        'hewan_id', 'dokter_id', 'tanggal', 'kondisi',
        'vaksinasi', 'file_hasil', 'layak_adopsi'
    ];

    public function hewan(): BelongsTo
    {
        return $this->belongsTo(ChelsiAnimal::class, 'hewan_id');
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(ChelsiUser::class, 'dokter_id');
    }

    
}
