<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['L', 'P'];
        return [
            'username' => fake()->name(),
            'tanggal_lahir' => fake()->date(),
            'alamat' => fake()->sentence(),
            'jenis_kelamin' => $gender[rand(0,1)],
        ];
    }
}
