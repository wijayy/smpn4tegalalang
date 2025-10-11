<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapelList = [
            'Bahasa Indonesia' => 5,
            'Matematika' => 5,
            'IPA' => 5,
            'IPS' => 5,
            'Agama' => 3,
            'PPKn' => 3,
            'Bahasa Inggris' => 3,
            'Seni Budaya' => 3,
            'PJOK' => 3,
            'Prakarya' => 2,
            'Muatan Lokal' => 2,
        ];

        $counter = 1;

        foreach ($mapelList as $mapelName => $jam) {
            $mapel = Mapel::where('nama', $mapelName)->first();



            if ($mapel) {
                $user = User::factory()->create([
                    'name' => "Guru {$mapelName} {$counter}",
                    'email' => "guru$counter@gmail.com",
                    'role' => 'guru'
                ]);
                Guru::factory()->recycle($user)->create([
                    'mapel_id' => $mapel->id,
                    // 'total_jam_mingguan' => $jam,
                ]);
                $counter++;
            }
        }
    }
}
