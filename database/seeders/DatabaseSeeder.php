<?php

namespace Database\Seeders;

use App\Models\Pimpinan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            KaprodiSeeder::class,
            PimpinanSeeder::class,
            MahasiswaSeeder::class,
            DosenSeeder::class,
            JenisSuratSeeder::class,
            TemplateSuratSeeder::class,
        ]);
    }
}
