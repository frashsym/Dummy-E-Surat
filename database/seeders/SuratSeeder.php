<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratSeeder extends Seeder
{
    public function run()
    {
        DB::table('surats')->insert([
            [
                'template_id' => 1,
                'nomor' => '001/FTI/2025',
                'perihal' => 'Permohonan Penelitian Sistem Informasi',
                'jenis' => 'Surat Permohonan',
                'kepada_yth' => 'Kaprodi Sistem Informasi',
                'tujuan' => 'Penelitian Kampus',
                'tanggal_surat' => '2025-01-01',
                'isi_html' => '<p>Isi permohonan penelitian...</p>',
                'pengirim' => 2,
                'penerima' => 1,
                'status' => 'acc',
                'created_at' => now()
            ],
            [
                'template_id' => 2,
                'nomor' => '002/FTI/2025',
                'perihal' => 'Keterangan Aktif Kuliah',
                'jenis' => 'Surat Keterangan',
                'kepada_yth' => 'Bagian Akademik',
                'tujuan' => 'Beasiswa',
                'tanggal_surat' => '2025-01-05',
                'isi_html' => '<p>Mahasiswa aktif pada semester...</p>',
                'pengirim' => 3,
                'penerima' => 1,
                'status' => 'pending',
                'created_at' => now()
            ],
            [
                'template_id' => 3,
                'nomor' => '003/FTI/2025',
                'perihal' => 'Pengunduran Diri dari Mata Kuliah',
                'jenis' => 'Surat Pengunduran Diri',
                'kepada_yth' => 'Dosen Pengampu',
                'tujuan' => 'Penarikan Mata Kuliah',
                'tanggal_surat' => '2025-01-10',
                'isi_html' => '<p>Saya mengundurkan diri...</p>',
                'pengirim' => 4,
                'penerima' => 1,
                'status' => 'ditolak',
                'created_at' => now()
            ],
            [
                'template_id' => 4,
                'nomor' => '004/FTI/2025',
                'perihal' => 'Penugasan Mengajar Semester Genap',
                'jenis' => 'Surat Tugas Mengajar',
                'kepada_yth' => 'Dosen Teknologi Informasi',
                'tujuan' => 'Mengajar Rekayasa Perangkat Lunak',
                'tanggal_surat' => '2025-01-12',
                'isi_html' => '<p>Dosen ditugaskan mengajar...</p>',
                'pengirim' => 1,
                'penerima' => 2,
                'status' => 'draft',
                'created_at' => now()
            ],
        ]);
    }
}
