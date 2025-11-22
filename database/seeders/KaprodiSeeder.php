<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kaprodi;

class KaprodiSeeder extends Seeder
{
    public function run(): void
    {
        Kaprodi::create([
            'user_id' => 5,
            'nip' => '198505152023121003',
            'fakultas' => 'Teknik',
            'prodi' => 'Informatika',
            'ttd' => null,
        ]);
    }
}
