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
            $table->string('nomor')->unique(); // No surat resmi
            $table->string('lampiran')->nullable(); // path ke file PDF/DOC surat
            $table->string('perihal'); // subjek surat
            $table->string('kepada_yth'); // penerima surat
            $table->string('jenis'); // contoh: "Surat Masuk", "Surat Keluar", "Surat Keterangan"
            $table->string('tujuan')->nullable(); // Judul atau topik surat
            $table->date('tanggal_surat')->nullable(); // Tanggal yang tercantum di surat
            $table->date('tanggal_diterima')->nullable(); // untuk surat masuk
            $table->foreignId('pengirim')->nullable()->constrained('users')->nullOnDelete(); // penerima surat (prodi)
            $table->foreignId('penerima')->nullable()->constrained('users')->nullOnDelete(); // pembuat surat (dosen, mahasiswa)
            $table->text('isi')->nullable(); // ringkasan isi surat
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
