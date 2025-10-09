<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mapel>
 */
class MapelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->randomElement([
                'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Fisika',
                'Kimia', 'Biologi', 'Sejarah', 'Ekonomi', 'Geografi'
            ]),
            'kode' => strtoupper($this->faker->lexify('MAP???')),
            'jumlah_jam' => mt_rand(2, 5),
        ];
    }
}
