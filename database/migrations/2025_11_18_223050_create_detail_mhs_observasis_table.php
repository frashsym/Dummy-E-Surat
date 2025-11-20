<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_mhs_observasis', function (Blueprint $table) {
            $table->id();
            // FK ke surat observasi induk
            $table->unsignedBigInteger('obser_id');
            $table->foreign('obser_id')
                ->references('id')
                ->on('surat_permohonan_izin_observasis')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->string('nama_mhs');
            $table->string('nim');
            $table->string('prodi');
            $table->string('no_hp');
            $table->string('dosen_pembimbing');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('detail_mhs_observasis', function (Blueprint $table) {
            $table->dropForeign(['obser_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('detail_mhs_observasis');
    }
};
