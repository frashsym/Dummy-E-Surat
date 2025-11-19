<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_tugas_mengajars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_surat_id');
            $table->string('nama_dosen');
            $table->string('nidn_nidk');
            $table->string('prodi');
            $table->string('thn_akademik');
            $table->string('semester');
            $table->timestamps();

            $table->foreign('transaksi_surat_id')->references('id')->on('transaksi_surats')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_tugas_mengajars');
    }
};
