<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaKelas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasList = Kelas::all();
        $count = 0;
        $angkatan_id = 4;

        foreach ($kelasList as $kelas) {
            for ($i = 1; $i <= 30; $i++) {
                $count++;
                if ($count <= 240) {
                    $angkatan_id = 4;
                } elseif ($count <= 480) {
                    $angkatan_id = 5;
                } else {
                    $angkatan_id = 6;
                }
                $user = User::factory()->create([
                    // 'nama' => fake()->name(),
                    'email' => "siswa$count@gmail.com",
                    'role' => 'siswa',
                ]);
                // Buat siswa
                $siswa = Siswa::factory()->recycle($user)->create([
                    'nis' => fake()->unique()->numerify('##########'), // 10 digit
                    'jenis_kelamin' => fake()->randomElement(['L', 'P']),
                    'angkatan_id' => $angkatan_id,
                    'kelas_id' => $kelas->id,
                ]);
            }
        }
    }
}
