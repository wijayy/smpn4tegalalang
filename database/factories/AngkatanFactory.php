<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Angkatan>
 */
class AngkatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tahunMulai = $this->faker->year();
        return [
            'tahun_mulai' => $tahunMulai,
            'tahun_selesai' => $tahunMulai + 3, // contoh SMA 3 tahun
        ];
    }
}
