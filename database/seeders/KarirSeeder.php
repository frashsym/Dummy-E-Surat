<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KarirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karirs')->insert([
            [
                'nama_karir' => 'Frontend Developer',
                'deskripsi' => 'Mengembangkan antarmuka pengguna website menggunakan HTML, CSS, dan JavaScript modern.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_karir' => 'Backend Developer',
                'deskripsi' => 'Bertanggung jawab membangun logika server dan API menggunakan framework Laravel.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_karir' => 'UI/UX Designer',
                'deskripsi' => 'Mendesain tampilan dan pengalaman pengguna yang intuitif dan menarik.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_karir' => 'Project Manager',
                'deskripsi' => 'Mengelola jadwal, tim, dan jalannya proyek agar sesuai target dan kualitas.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_karir' => 'Content Writer',
                'deskripsi' => 'Membuat dan mengedit konten untuk website, blog, dan media sosial perusahaan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
