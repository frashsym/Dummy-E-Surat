<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_mengajars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_tugas_mengajar_id');
            $table->string('mata_kuliah');
            $table->string('kode_mk');
            $table->string('kelas');
            $table->integer('sks');
            $table->date('tanggal');
            $table->string('ruang');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();

            $table->foreign('surat_tugas_mengajar_id')->references('id')->on('surat_tugas_mengajars')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_mengajars');
    }
};
