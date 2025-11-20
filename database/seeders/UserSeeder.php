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
            'email' => 'super@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        // ADMINISTRATOR
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        // PIMPINAN
        User::create([
            'name' => 'Pimpinan Fakultas',
            'email' => 'pimpinan@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Wakil Dekan',
            'email' => 'wd@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);

        // PRODI
        User::create([
            'name' => 'Kaprodi',
            'email' => 'prodi@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 4,
        ]);

        // DOSEN
        User::create([
            'name' => 'Dosen',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 5,
        ]);

        // MAHASISWA
        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 6,
        ]);
    }
}
