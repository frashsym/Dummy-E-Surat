<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_tugas_mengajars', function (Blueprint $table) {
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

            $table->string('nama_dosen');
            $table->string('nidn_nidk');
            $table->string('prodi');
            $table->string('thn_akademik');
            $table->string('semester');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::table('surat_tugas_mengajars', function (Blueprint $table) {
            $table->dropForeign(['ts_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('surat_tugas_mengajars');
    }
};
