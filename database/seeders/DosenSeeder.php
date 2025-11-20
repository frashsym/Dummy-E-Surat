<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        Dosen::create([
            'user_id'            => 5,
            'nip'                => '198707102023121004',
            'nidn'               => '0123456789',
            'fakultas'           => 'Teknik',
            'prodi'              => 'Informatika',
            'jabatan_fungsional'=> 'Lektor',
            'pangkat_golongan'   => 'III/c',
            'no_hp'              => '081234567890',
            'alamat'             => 'Jl. Melati No. 21',
            'ttd'                => null,
        ]);
    }
}
