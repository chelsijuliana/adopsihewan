<?php

namespace Database\Factories;

use App\Models\ChelsiCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChelsiCategoryFactory extends Factory
{
    protected $model = ChelsiCategory::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->unique()->randomElement(['kucing', 'anjing', 'kelinci', 'hamster']),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
