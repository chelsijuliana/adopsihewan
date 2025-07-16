<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChelsiCategory;

class ChelsiCategorySeeder extends Seeder
{
    public function run(): void
    {
        $kategori = ['kucing', 'anjing', 'kelinci', 'hamster'];

        foreach ($kategori as $nama) {
            ChelsiCategory::firstOrCreate([
                'nama' => $nama,
            ], [
                'deskripsi' => 'Kategori hewan: ' . $nama,
            ]);
        }
    }
}
