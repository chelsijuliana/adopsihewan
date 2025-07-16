<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChelsiArticle extends Model
{
    protected $table = 'chelsi_articles';

    protected $fillable = [
        'judul', 'konten', 'foto', 'created_by'
    ];

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(ChelsiUser::class, 'created_by');
    }
    

    // Jika kamu tambahkan category_id di artikel, tambahkan relasi ini:
    /*
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(ChelsiCategory::class, 'category_id');
    }
    */
}
