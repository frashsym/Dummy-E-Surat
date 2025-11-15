<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSuratSeeder extends Seeder
{
    public function run()
    {
        DB::table('template_surats')->insert([
            [
                'nama_template' => 'Surat Permohonan',
                'html_template' => '
                    <p>Nomor: {nomor}</p>
                    <p>Perihal: {perihal}</p>
                    <p>Kepada Yth: {kepada_yth}</p>
                    <p>Isi: {isi}</p>
                    <p>Tanggal: {tanggal}</p>
                ',
                'editable_fields' => json_encode(['perihal','kepada_yth','isi','tanggal']),
                'created_at' => now()
            ],
            [
                'nama_template' => 'Surat Keterangan',
                'html_template' => '
                    <p>Nomor: {nomor}</p>
                    <p>Keterangan: {isi}</p>
                    <p>Diberikan kepada: {kepada_yth}</p>
                    <p>Tanggal: {tanggal}</p>
                ',
                'editable_fields' => json_encode(['isi','kepada_yth','tanggal']),
                'created_at' => now()
            ],
            [
                'nama_template' => 'Surat Pengunduran Diri',
                'html_template' => '
                    <p>Nomor: {nomor}</p>
                    <p>Kepada Yth: {kepada_yth}</p>
                    <p>Dengan hormat,</p>
                    <p>{isi}</p>
                    <p>Tanggal Efektif: {tanggal}</p>
                ',
                'editable_fields' => json_encode(['kepada_yth','isi','tanggal']),
                'created_at' => now()
            ],
            [
                'nama_template' => 'Surat Tugas Mengajar',
                'html_template' => '
                    <p>Nomor: {nomor}</p>
                    <p>Dosen yang ditugaskan: {kepada_yth}</p>
                    <p>Untuk Mengajar: {tujuan}</p>
                    <p>Waktu Pelaksanaan: {tanggal}</p>
                ',
                'editable_fields' => json_encode(['kepada_yth','tujuan','tanggal']),
                'created_at' => now()
            ],
            [
                'nama_template' => 'Surat Ujian Susulan',
                'html_template' => '
                    <p>Nomor: {nomor}</p>
                    <p>Nama Mahasiswa: {kepada_yth}</p>
                    <p>Alasan: {isi}</p>
                    <p>Jadwal Ujian Susulan: {tanggal}</p>
                ',
                'editable_fields' => json_encode(['kepada_yth','isi','tanggal']),
                'created_at' => now()
            ],
        ]);
    }
}
