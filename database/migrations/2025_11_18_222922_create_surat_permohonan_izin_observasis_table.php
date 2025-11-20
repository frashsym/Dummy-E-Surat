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
            $table->dropForeign(['ts_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('surat_permohonan_izin_observasis');
    }
};
