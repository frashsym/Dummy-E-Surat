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
        Schema::create('surat_permohonan_studi_praktek_akuntansis', function (Blueprint $table) {
            $table->id();

            // Relasi ke transaksi_surats
            $table->foreignId('transaksi_surat_id')
                ->constrained('transaksi_surats')
                ->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('lampiran')->nullable();
            $table->string('perihal');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('kepada_yth')->nullable();
            $table->string('nama_mhs');
            $table->string('npm');
            $table->string('tingkat_semester');
            $table->string('konsentrasi');
            $table->string('no_hp');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_permohonan_studi_praktek_akuntansis', function (Blueprint $table) {
            $table->dropForeign(['transaksi_surat_id']);
        });

        Schema::dropIfExists('surat_permohonan_studi_praktek_akuntansis');
    }
};
