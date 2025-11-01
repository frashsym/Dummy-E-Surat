<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanans')->insert([
            [
                'nama_layanan' => 'Pembuatan Website',
                'deskripsi' => 'Layanan pembuatan website profesional untuk bisnis, portofolio, dan instansi.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_layanan' => 'Desain Grafis',
                'deskripsi' => 'Menyediakan layanan desain logo, brosur, banner, dan kebutuhan branding lainnya.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_layanan' => 'Digital Marketing',
                'deskripsi' => 'Strategi pemasaran digital untuk meningkatkan visibilitas dan penjualan online.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_layanan' => 'Pengelolaan Sosial Media',
                'deskripsi' => 'Membantu mengelola konten dan interaksi di platform media sosial secara profesional.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_layanan' => 'Konsultasi IT',
                'deskripsi' => 'Memberikan solusi teknologi dan strategi IT untuk mendukung transformasi digital.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
