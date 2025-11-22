<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TemplateSuratSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('template_surats')->insert([
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Studi Praktek Akuntansi',
                'slug' => 'surat-permohonan-studi-praktek-akuntansi',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Izin Penelitian',
                'slug' => 'surat-permohonan-izin-penelitian',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Studi Praktek Manajemen',
                'slug' => 'surat-permohonan-studi-praktek-manajemen',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Izin Observasi',
                'slug' => 'surat-permohonan-izin-observasi',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Keterangan Masih Kuliah',
                'slug' => 'surat-keterangan-masih-kuliah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Keterangan Masih Kuliah Dengan Orang Tua',
                'slug' => 'surat-keterangan-masih-kuliah-dengan-orang-tua',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Aktif Kuliah',
                'slug' => 'surat-permohonan-aktif-kuliah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Pengajuan Permohonan Perpindahan Ke Kelas Reguler Sore',
                'slug' => 'surat-pengajuan-permohonan-perpindahan-ke-kelas-reguler-sore',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Cuti/Aktif Mengundurkan Diri',
                'slug' => 'surat-permohonan-cuti-aktif-mengundurkan-diri',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Pindah Kuliah',
                'slug' => 'surat-permohonan-pindah-kuliah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Pengunduran Diri',
                'slug' => 'surat-pengunduran-diri',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Ujian Susulan',
                'slug' => 'surat-ujian-susulan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Ujian Susulan Dengan Matkul',
                'slug' => 'surat-ujian-susulan-dengan-matkul',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Tugas Mengajar',
                'slug' => 'surat-tugas-mengajar',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
