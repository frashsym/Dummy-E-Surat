<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::create([
            'nama' => 'Mahasiswa Contoh',
            'nim' => '2201001001',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('password'),
            'profile' => null,
        ]);
    }
}
