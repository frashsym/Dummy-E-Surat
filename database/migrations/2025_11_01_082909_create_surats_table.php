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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique(); // No surat resmi
            $table->string('jenis_surat'); // contoh: "Surat Masuk", "Surat Keluar", "Surat Keterangan"
            $table->string('perihal')->nullable(); // Judul atau topik surat
            $table->date('tanggal_surat')->nullable(); // Tanggal yang tercantum di surat
            $table->date('tanggal_diterima')->nullable(); // untuk surat masuk
            $table->string('pengirim')->nullable(); // bisa nama instansi/pihak pengirim
            $table->string('penerima')->nullable(); // untuk surat keluar
            $table->text('isi_singkat')->nullable(); // ringkasan isi surat
            $table->string('lampiran')->nullable(); // path ke file PDF/DOC surat
            $table->enum('status', ['draft', 'terkirim', 'diterima', 'arsip'])->default('draft');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // pembuat surat
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
