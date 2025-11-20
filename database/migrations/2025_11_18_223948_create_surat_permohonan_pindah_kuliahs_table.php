<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_permohonan_pindah_kuliahs', function (Blueprint $table) {
            $table->id();

            // FK ts_id
            $table->unsignedBigInteger('ts_id');
            $table->foreign('ts_id')
                ->references('id')
                ->on('transaksi_surats')
                ->cascadeOnDelete();

            // user_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            // Kolom surat
            $table->string('yth');
            $table->string('nama_mhs');
            $table->string('npm');
            $table->string('prodi');
            $table->string('fakultas')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('nama_ortu')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('surat_permohonan_pindah_kuliahs', function (Blueprint $table) {
            $table->dropForeign(['ts_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('surat_permohonan_pindah_kuliahs');
    }
};
