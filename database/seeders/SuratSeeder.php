<?php

namespace Database\Seeders;

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
            [
                'nomor_surat' => '001/SM/XI/2025',
                'jenis' => 'Surat Masuk',
                'tujuan' => 'Kerjasama Penelitian',
                'tanggal_surat' => '2025-10-30',
                'tanggal_diterima' => '2025-10-31',
                'pengirim' => 3, // User ID 3
                'penerima' => 2, // User ID 2 (Prodi)
                'isi' => 'Permohonan kerjasama penelitian antara PT Sinar Jaya dan universitas.',
                'lampiran' => 'dokumen/kerjasama_penelitian.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_surat' => '002/SK/XI/2025',
                'jenis' => 'Surat Keluar',
                'tujuan' => 'Permohonan Magang',
                'tanggal_surat' => '2025-11-01',
                'tanggal_diterima' => null,
                'pengirim' => 4, // User ID 4
                'penerima' => 2, // User ID 2 (Prodi)
                'isi' => 'Surat pengantar permohonan magang mahasiswa ke perusahaan mitra.',
                'lampiran' => 'dokumen/permohonan_magang.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_surat' => '003/SK/XI/2025',
                'jenis' => 'Surat Keterangan',
                'tujuan' => 'Keterangan Aktif Kuliah',
                'tanggal_surat' => '2025-11-02',
                'tanggal_diterima' => null,
                'pengirim' => 3, // User ID 3
                'penerima' => 2, // User ID 2 (Prodi)
                'isi' => 'Surat keterangan mahasiswa aktif untuk keperluan administrasi.',
                'lampiran' => 'dokumen/surat_keterangan_aktif.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
