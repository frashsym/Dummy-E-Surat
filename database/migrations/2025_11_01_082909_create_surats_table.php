<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratsTable extends Migration
{
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();

            $table->string('nomor')->nullable()->unique(); // nomor surat final
            $table->string('perihal'); // judul surat
            $table->string('jenis')->nullable(); // opsional
            $table->string('kepada_yth')->nullable();
            $table->string('tujuan')->nullable();

            $table->date('tanggal_surat')->nullable();
            $table->date('tanggal_diterima')->nullable();

            // relasi user
            $table->foreignId('pengirim')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('penerima')->nullable()->constrained('users')->nullOnDelete();

            $table->longText('isi_html')->nullable(); // hasil HTML final
            $table->string('lampiran')->nullable(); // pdf final

            $table->string('status')->default('draft'); // draft, dikirim, ditolak, acc

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surats');
    }
}
