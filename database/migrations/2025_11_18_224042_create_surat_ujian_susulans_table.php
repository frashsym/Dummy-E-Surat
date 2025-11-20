<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_ujian_susulans', function (Blueprint $table) {
            $table->id();
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
            $table->string('kepada');
            $table->string('nama_mhs');
            $table->string('npm');
            $table->string('tingkat_semester');
            $table->string('prodi');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::table('surat_ujian_susulans', function (Blueprint $table) {
            $table->dropForeign(['ts_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('surat_ujian_susulans');
    }
};
