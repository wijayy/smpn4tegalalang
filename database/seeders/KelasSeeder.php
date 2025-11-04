<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(7, 9) as $tingkat) {
            foreach (['A', 'B', 'C', 'D', 'E'] as $rombel) {
                Kelas::factory()->recycle(Guru::all())->create([
                    'nama' => "Kelas {$tingkat} {$rombel}",
                    'tingkat' => $tingkat,
                ]);
            }
        }
    }
}
