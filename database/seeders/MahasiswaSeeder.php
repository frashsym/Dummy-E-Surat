<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\User;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Insert data mahasiswa
        Mahasiswa::create([
            'user_id'      => 6,
            'npm'          => '123456789',
            'fakultas'     => 'Teknik',
            'prodi'        => 'Informatika',
            'angkatan'     => '2022',
            'kelas'        => 'IF-2',
            'jenis_kelamin'=> 'L',
            'tgl_lahir'    => '2003-01-12',
            'no_hp'        => '081234567890',
            'alamat'       => 'Jl. Kenanga No. 12'
        ]);
    }
}
