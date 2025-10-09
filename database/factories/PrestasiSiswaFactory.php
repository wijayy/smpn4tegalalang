<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrestasiSiswa>
 */
class PrestasiSiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'siswa_id' => Siswa::inRandomOrder()->first()->id ?? Siswa::factory(),
            'nama_prestasi' => $this->faker->sentence(3),
            'tingkat' => $this->faker->randomElement(['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional']),
            'tahun' => $this->faker->year(),
            'keterangan' => $this->faker->optional()->paragraph(),
        ];
    }
}
