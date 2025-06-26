<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChelsiCategory extends Model
{
    protected $table = 'chelsi_categories';

    protected $fillable = ['nama', 'deskripsi'];

    public function artikel(): HasMany
    {
        return $this->hasMany(ChelsiArticle::class, 'category_id');
    }
}
