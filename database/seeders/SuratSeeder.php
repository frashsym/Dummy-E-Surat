<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('surats')->insert([
            'nomor_surat' => '001/SM/XI/2025',
            'jenis_surat' => 'Surat Masuk',
            'perihal' => 'Permohonan Kerjasama',
            'tanggal_surat' => '2025-10-30',
            'tanggal_diterima' => '2025-10-31',
            'pengirim' => 'PT Sinar Jaya Abadi',
            'penerima' => 'Bagian Administrasi',
            'isi_singkat' => 'Permohonan kerjasama dalam penyediaan layanan teknologi informasi.',
            'lampiran' => 'dokumen/permohonan_kerjasama.pdf',
            'status' => 'diterima',
            'user_id' => 1, // pastikan user dengan ID 1 ada
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
