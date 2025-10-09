<?php

namespace Database\Factories;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tingkat = $this->faker->numberBetween(1, 3);
        $jurusan = $this->faker->randomElement(['IPA', 'IPS', 'Bahasa']);
        $rombel = $this->faker->numberBetween(1, 3);

        return [
            'nama' => "{$tingkat} {$jurusan} {$rombel}",
            'tingkat' => $tingkat,
            'guru_id' => Guru::inRandomOrder()->first()->id ?? Guru::factory(),
        ];
    }
}
