<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pimpinan;

class PimpinanSeeder extends Seeder
{
    public function run(): void
    {
        Pimpinan::create([
            'nama' => 'Pimpinan Utama',
            'email' => 'pimpinan@gmail.com',
            'password' => Hash::make('password'),
            'wd' => null,
            'signature' => null,
            'profile' => null,
        ]);
    }
}
