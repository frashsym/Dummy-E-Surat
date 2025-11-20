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
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Izin Penelitian',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Studi Praktek Manajemen',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Izin Observasi',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Keterangan Masih Kuliah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Keterangan Masih Kuliah Dengan Orang Tua',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Aktif Kuliah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Pengajuan Permohonan Perpindahan Ke Kelas Reguler Sore',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Cuti/Aktif Mengundurkan Diri',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Pindah Kuliah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Pengunduran Diri',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Ujian Susulan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Ujian Susulan Dengan Matkul',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Tugas Mengajar',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
