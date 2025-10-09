<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiswaKelas>
 */
class SiswaKelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tahunAwal = $this->faker->numberBetween(2020, 2025);
        return [
            'siswa_id' => Siswa::inRandomOrder()->first()->id ?? Siswa::factory(),
            'kelas_id' => Kelas::inRandomOrder()->first()->id ?? Kelas::factory(),
            'tahun_ajaran' => "{$tahunAwal}/" . ($tahunAwal + 1),
            'status_naik' => $this->faker->randomElement(['naik', 'tinggal']),
            'catatan' => $this->faker->optional()->sentence(),
        ];
    }
}
