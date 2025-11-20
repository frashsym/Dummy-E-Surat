<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_permohonan_aktif_kuliahs', function (Blueprint $table) {
            $table->id();

            // FK ke transaksi surat
            $table->unsignedBigInteger('ts_id');
            $table->foreign('ts_id')
                ->references('id')
                ->on('transaksi_surats')
                ->cascadeOnDelete();

            // user_id setelah ts_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            // Kolom-kolom surat
            $table->string('perihal');
            $table->string('yth');
            $table->string('nama_mhs');
            $table->string('npm');
            $table->string('prodi');
            $table->string('fakultas')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('semester');
            $table->string('thn_akademik');
            $table->text('alasan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_permohonan_aktif_kuliahs', function (Blueprint $table) {
            $table->dropForeign(['ts_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('surat_permohonan_aktif_kuliahs');
    }
};
