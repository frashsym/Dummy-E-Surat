<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pimpinan;

class PimpinanSeeder extends Seeder
{
    public function run(): void
    {
        // Pimpinan Fakultas
        Pimpinan::create([
            'user_id'  => 3, // dari seeder User
            'nip'      => '197812312023121001',
            'jabatan'  => 'Dekan',
            'fakultas' => 'Teknik',
            'prodi'    => null,
            'ttd'      => null,
        ]);

        // Wakil Dekan
        Pimpinan::create([
            'user_id'  => 3,
            'nip'      => '198003052023121002',
            'jabatan'  => 'Wakil Dekan',
            'wd' => 1,
            'fakultas' => 'Teknik',
            'prodi'    => null,
            'ttd'      => null,
        ]);
    }
}
