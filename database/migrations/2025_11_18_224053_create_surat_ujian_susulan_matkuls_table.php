<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_ujian_susulan_matkuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_surat_id');
            $table->string('lampiran')->nullable();
            $table->string('perihal');
            $table->string('kepada');
            $table->string('nama_mhs');
            $table->string('npm');
            $table->string('tingkat_semester');
            $table->string('prodi');
            $table->string('matkul');
            $table->timestamps();

            $table->foreign('transaksi_surat_id')->references('id')->on('transaksi_surats')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_ujian_susulan_matkuls');
    }
};
