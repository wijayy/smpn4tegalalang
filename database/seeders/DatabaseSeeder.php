<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'role'=>'admin',
        ]);

        $this->call(AngkatanSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PrestasiSiswaSeeder::class);
    }
}
