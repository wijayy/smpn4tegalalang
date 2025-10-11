<?php

namespace Database\Factories;

use App\Models\Angkatan;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
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
            'nis' => $this->faker->unique()->numerify('########'),
            'nisn' => fake()->numerify("00##################"),
            'alamat' => fake()->address(),
            'no_telp'=>fake()->phoneNumber(),
            'tanggal_lahir' => $this->faker->date('Y-m-d'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'angkatan_id' => Angkatan::inRandomOrder()->first()->id ?? Angkatan::factory(),
            'siswa_tidak_mampu' => $this->faker->boolean(20), // 20% kemungkinan tidak mampu
            'status' => $this->faker->randomElement(['aktif', 'lulus', 'keluar']),
            'user_id' => User::factory(),
            'kelas_id' => Kelas::factory(),
        ];
    }
}
