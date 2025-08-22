<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GaleriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(4),
            'gambar' => 'galeri/' . $this->faker->image('public/storage/galeri', 640, 480, null, false),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
