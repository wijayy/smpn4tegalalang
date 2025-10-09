<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalMengajar>
 */
class JadwalMengajarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jamMulai = $this->faker->time('H:i');
        $jamSelesai = date('H:i', strtotime($jamMulai) + 45 * 60); // + 45 menit

        return [
            'kelas_id' => Kelas::inRandomOrder()->first()->id ?? Kelas::factory(),
            'mapel_id' => Mapel::inRandomOrder()->first()->id ?? Mapel::factory(),
            'guru_id' => Guru::inRandomOrder()->first()->id ?? Guru::factory(),
            'hari' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']),
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ];
    }
}
