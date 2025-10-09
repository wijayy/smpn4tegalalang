<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapels = [
            ['nama' => 'Bahasa Indonesia', 'jumlah_jam' => 5, 'mapel_besar' => true],
            ['nama' => 'Matematika', 'jumlah_jam' => 5, 'mapel_besar' => true],
            ['nama' => 'IPA', 'jumlah_jam' => 5, 'mapel_besar' => true],
            ['nama' => 'IPS', 'jumlah_jam' => 5, 'mapel_besar' => true],
            ['nama' => 'Agama', 'jumlah_jam' => 3],
            ['nama' => 'PPKN', 'jumlah_jam' => 3],
            ['nama' => 'Bahasa Inggris', 'jumlah_jam' => 3],
            ['nama' => 'Seni Budaya', 'jumlah_jam' => 3],
            ['nama' => 'PJOK', 'jumlah_jam' => 3, 'boleh_senin' => false],
            ['nama' => 'Prakarya', 'jumlah_jam' => 2],
            ['nama' => 'Muatan Lokal', 'jumlah_jam' => 2],
        ];

        foreach ($mapels as $item) {
            Mapel::create($item);
        }
    }
}
