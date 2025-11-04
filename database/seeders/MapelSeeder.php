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
            ['nama' => 'Pend Pancasila', 'jumlah_jam' => 3],
            ['nama' => 'Bahasa Inggris', 'jumlah_jam' => 3],
            ['nama' => 'Seni Budaya', 'jumlah_jam' => 3],
            ['nama' => 'PJOK', 'jumlah_jam' => 3, 'boleh_senin' => false],
            ['nama' => 'Bahasa Bali', 'jumlah_jam' => 2],
            ['nama' => 'TIK', 'jumlah_jam' => 2],
            ['nama' => 'BK', 'jumlah_jam' => 2],
            ['nama' => 'Upacara Bendera', 'jumlah_jam' => 1],
            ['nama' => 'GB', 'jumlah_jam' => 1],
            ['nama' => 'Pembiasaan', 'jumlah_jam' => 3],
        ];

        foreach ($mapels as $item) {
            Mapel::create($item);
        }
    }
}
