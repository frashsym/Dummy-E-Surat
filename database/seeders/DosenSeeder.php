<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        Dosen::create([
            'nama' => 'Dosen Contoh',
            'nidn' => '1234567890',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('password'),
            'profile' => null,
        ]);
    }
}
