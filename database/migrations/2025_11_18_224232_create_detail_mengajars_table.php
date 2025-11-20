<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_mengajars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mengajar_id');
            $table->foreign('mengajar_id')
                ->references('id')
                ->on('surat_tugas_mengajars')
                ->cascadeOnDelete();

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

        });
    }

    public function down(): void
    {
        Schema::table('surat_tugas_mengajars', function (Blueprint $table) {
            $table->dropForeign(['mengajar_id']);
        });
        Schema::dropIfExists('detail_mengajars');
    }
};
