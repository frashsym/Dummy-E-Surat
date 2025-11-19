<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_pengunduran_diris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_surat_id');
            $table->string('yth');
            $table->string('nama_mhs');
            $table->string('npm');
            $table->string('tingkat_semester');
            $table->string('prodi');
            $table->string('nama_ortu');
            $table->timestamps();

            $table->foreign('transaksi_surat_id')->references('id')->on('transaksi_surats')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_pengunduran_diris');
    }
};
