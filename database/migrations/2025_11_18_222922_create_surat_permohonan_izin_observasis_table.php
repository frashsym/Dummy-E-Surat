<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_permohonan_izin_observasis', function (Blueprint $table) {
            $table->id();

            // Relasi ke transaksi_surats
            $table->foreignId('transaksi_surat_id')
                ->constrained('transaksi_surats')
                ->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('lampiran')->nullable();
            $table->string('perihal');
            $table->string('kepada_yth')->nullable();
            $table->date('tgl_pelaksanaan');

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
        Schema::table('surat_permohonan_izin_observasis', function (Blueprint $table) {
            $table->dropForeign(['transaksi_surat_id']);
        });

        Schema::dropIfExists('surat_permohonan_izin_observasis');
    }
};
