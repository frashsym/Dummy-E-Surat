<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        Prodi::create([
            'nama' => 'Ketua Prodi Informatika',
            'email' => 'prodi@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
