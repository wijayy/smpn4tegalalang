<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(2020, 2027) as $item) {
            Angkatan::create(['tahun_mulai' => $item, 'tahun_selesai' => $item + 3]);
        }
    }
}
