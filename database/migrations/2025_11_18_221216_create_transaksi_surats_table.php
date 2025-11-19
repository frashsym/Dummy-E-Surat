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
        Schema::create('transaksi_surats', function (Blueprint $table) {
            $table->id();
            // template surat yang dipakai
            $table->foreignId('template_surat_id')->constrained('template_surat')->cascadeOnDelete();

            // ID surat spesifik, mengarah ke tabel surat template tertentu
            $table->unsignedBigInteger('surat_id');

            $table->string('nomor_surat');
            $table->integer('tahun')->default(date('Y'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key dulu sebelum drop table
        Schema::table('transaksi_surats', function (Blueprint $table) {
            $table->dropForeign(['template_surat_id']);
        });
        Schema::dropIfExists('transaksi_surats');
    }
};
