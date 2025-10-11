<?php

namespace Database\Seeders;

use App\Models\PrestasiSiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestasiSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrestasiSiswa::factory(20)->create();
    }
}
