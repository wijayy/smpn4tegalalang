<?php

namespace Database\Factories;

use App\Models\Mapel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'nama' => $this->faker->name(),
            'kode' => fake()->numerify('KD###'),
            'no_pegawai' => $this->faker->optional()->numerify('1975#########'),
            'alamat' => fake()->address(),
            'no_telp'=>fake()->phoneNumber(),
            'mapel_id' => Mapel::inRandomOrder()->first()->id ?? Mapel::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
