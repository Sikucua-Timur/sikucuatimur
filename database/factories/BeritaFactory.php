<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BeritaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(6),
            'konten' => $this->faker->paragraphs(3, true),
            'gambar' => 'berita/' . $this->faker->image('public/storage/berita', 640, 480, null, false),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
