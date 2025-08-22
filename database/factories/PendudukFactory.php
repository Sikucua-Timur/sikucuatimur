<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PendudukFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nik' => $this->faker->unique()->numerify('3276##########'),
            'kk' => $this->faker->numerify('3276##########'),
            'alamat' => $this->faker->address(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
