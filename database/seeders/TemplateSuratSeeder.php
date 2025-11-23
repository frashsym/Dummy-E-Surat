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
                'kop_surat' => "kop.jpg",
                'body_template' => "
<p><strong>Nomor:</strong> {{ nomor_surat }}</p>
<p><strong>Lampiran:</strong> {{ lampiran }}</p>
<p><strong>Perihal:</strong> {{ perihal }}</p>

<p style='text-align: right;'>Cirebon, {{ tgl_surat }}</p>

<p><strong>Kepada Yth:</strong><br>
{{ kepada_yth }}</p>

<p>Dengan hormat,</p>

<p>Salam sejahtera semoga kita semua senantiasa berada dalam rahmat dan karunia Allah SWT.</p>

<p>
Dalam rangka peningkatan kompetensi mahasiswa dalam dunia kerja, dengan ini kami mohon kiranya Mahasiswa Program Studi Akuntansi Fakultas Ekonomi dan Bisnis UGJ Cirebon dapat diizinkan untuk melaksanakan Studi Praktek Akuntansi terhitung sejak tanggal
<strong>{{ tgl_mulai }}</strong> s.d. <strong>{{ tgl_selesai }}</strong>.
</p>

<p>Adapun mahasiswa yang dimaksud adalah sebagai berikut:</p>

<p>
Nama Mahasiswa : <strong>{{ nama_mhs }}</strong><br>
NPM : <strong>{{ npm }}</strong><br>
Tingkat/Semester : <strong>{{ tingkat_semester }}</strong><br>
Konsentrasi : <strong>{{ konsentrasi }}</strong><br>
No. HP : <strong>{{ no_hp }}</strong>
</p>

<p>
Besar harapan kami, dapat memberikan izin kepada Mahasiswa tersebut di atas untuk melaksakan Studi Praktek Akuntansi di perusahaan yang Bapak/Ibu pimpin.
</p>

<p>
Demikian surat permohonan ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.
</p>

<br><br>

<p><strong>A.n Dekan</strong><br>
<strong>{{ pimpinan_jabatan }}</strong></p>
<br>
{{ pimpinan_ttd }}
<br>
<p><strong>{{ pimpinan_nama }}</strong></p>
                ",
                'pimpinan_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Izin Penelitian',
                'slug' => 'surat-permohonan-izin-penelitian',
                'kop_surat' => null,
                'body_template' => "<p>Dengan hormat,</p>

<p>Salam sejahtera semoga kita semua senantiasa berada dalam rahmat dan karunia Allah SWT. Dalam rangka penyusunan Tugas Akhir KITAM (Karya Ilmiah Tugas Akhir Mahasiswa), bersama ini kami sampaikan permohonan izin untuk melakukan penelitian melalui survei, pengambilan data, dan wawancara yang akan dilaksanakan oleh Mahasiswa kami, atas nama:</p>

<p>Nama Mahasiswa : <strong>{{ nama_mhs }}</strong><br>
NPM : <strong>{{ npm }}</strong><br>
Tingkat/Semester : <strong>{{ tingkat_semester }}</strong><br>
Program Studi / Konsentrasi : <strong>{{ prodi_konsen }}</strong><br>
No. HP : <strong>{{ no_hp }}</strong></p>

<p>Dosen Kolaborator:<br>
<strong>{{ dosen_kolab }}</strong></p>

<p>Adapun topik penelitian yang akan dibahas yaitu: <strong>{{ topik_penelitian }}</strong>.</p>

<p>Besar harapan kami, Bapak/Ibu dapat memberikan izin kepada Mahasiswa kami untuk melaksanakan penelitian di <strong>{{ tmpt_penelitian }}</strong>.</p>

<p>Demikian surat permohonan ini kami sampaikan. Atas perhatiannya, kami ucapkan terima kasih.</p>
",

                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Studi Praktek Manajemen',
                'slug' => 'surat-permohonan-studi-praktek-manajemen',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Izin Observasi',
                'slug' => 'surat-permohonan-izin-observasi',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Keterangan Masih Kuliah',
                'slug' => 'surat-keterangan-masih-kuliah',
                'kop_surat' => null,
                'body_template' => "<p><strong>SURAT KETERANGAN MASIH KULIAH</strong></p>

                <p>Nomor: {{ nomor_surat }}</p>

                <p>Yang bertandatangan di bawah ini:</p>

                <p>
                Nama: {{ nama_dosen }}<br>
                NIDN: {{ nidn }}<br>
                Jabatan: {{ jabatan_dosen }}<br>
    Pada Perguruan Tinggi: {{ pada_perguruan_tinggi }}
</p>

<p>Menerangkan dengan sesungguhnya bahwa:</p>

<p>
Nama Mahasiswa: {{ nama_mhs }}<br>
    NIM: {{ nim }}<br>
    Program Studi: {{ prodi }}<br>
    Tingkat/Semester: {{ tingkat_semester }}<br>
    Tahun Akademik: {{ thn_akademik }}
    </p>

    <p>
    Adalah benar terdaftar sebagai mahasiswa kami dan sedang aktif kuliah.
    Surat ini dibuat untuk keperluan <strong>{{ keperluan }}</strong>.
</p>

<p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>

<p>Cirebon, {{ tgl_surat }}</p>
",
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Keterangan Masih Kuliah Ortu Detail',
                'slug' => 'surat-keterangan-masih-kuliah-dengan-orang-tua',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Aktif Kuliah',
                'slug' => 'surat-permohonan-aktif-kuliah',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Pengajuan Permohonan Perpindahan Ke Kelas Reguler Sore',
                'slug' => 'surat-pengajuan-permohonan-perpindahan-ke-kelas-reguler-sore',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Cuti/Aktif/Mengundurkan Diri',
                'slug' => 'surat-permohonan-cuti-aktif-mengundurkan-diri',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Permohonan Pindah Kuliah',
                'slug' => 'surat-permohonan-pindah-kuliah',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Pengunduran Diri',
                'slug' => 'surat-pengunduran-diri',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Ujian Susulan',
                'slug' => 'surat-ujian-susulan',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Ujian Susulan Dengan Matkul',
                'slug' => 'surat-ujian-susulan-dengan-matkul',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jenis_surat_id' => 1,
                'nama_template' => 'Surat Tugas Mengajar',
                'slug' => 'surat-tugas-mengajar',
                'kop_surat' => null,
                'body_template' => null,
                'pimpinan_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
