<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratsTable extends Migration
{
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();

            // header
            $table->string('header_logo')->nullable();  // path logo kampus
            $table->json('header_info')->nullable();    // json: alamat, telp, kode pos

            // info surat utama
            $table->string('nomor')->nullable()->unique();
            $table->string('perihal');
            $table->string('jenis')->nullable();

            $table->string('kepada_yth')->nullable();
            $table->string('tujuan')->nullable();

            $table->date('tanggal_surat')->nullable();
            $table->date('tanggal_diterima')->nullable();

            // data mahasiswa diinput manual
            $table->string('mhs_nama')->nullable();
            $table->string('mhs_npm')->nullable();
            $table->string('mhs_tingkat')->nullable();
            $table->string('mhs_semester')->nullable();
            $table->string('mhs_konsentrasi')->nullable();
            $table->string('mhs_nohp')->nullable();

            // data pejabat penanda tangan (manual)
            $table->string('penandatangan_jabatan')->nullable();
            $table->string('penandatangan_nama')->nullable();
            $table->string('penandatangan_signature')->nullable(); // path tanda tangan

            // relasi (opsional)
            $table->foreignId('pengirim')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('penerima')->nullable()->constrained('users')->nullOnDelete();

            // hasil
            $table->longText('isi_html')->nullable();
            $table->string('lampiran')->nullable();

            $table->string('status')->default('draft');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surats');
    }
}
