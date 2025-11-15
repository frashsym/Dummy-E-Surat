<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // SUPERADMIN
        User::create([
            'name' => 'Superadmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        // PIMPINAN
        User::create([
            'name' => 'Pimpinan Fakultas',
            'email' => 'pimpinan@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        // PRODI
        User::create([
            'name' => 'Kaprodi Informatika',
            'email' => 'prodi@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);

        // DOSEN
        User::create([
            'name' => 'Dosen Informatika',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 4,
        ]);

        // MAHASISWA
        User::create([
            'name' => 'Mahasiswa Uji Coba',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 5,
        ]);
    }
}
