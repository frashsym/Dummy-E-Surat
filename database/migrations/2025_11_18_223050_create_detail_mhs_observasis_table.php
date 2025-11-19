<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_mhs_observasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // FK ke surat observasi induk
            $table->foreignId('surat_observasi_id')
                ->constrained('surat_permohonan_izin_observasis')
                ->cascadeOnDelete();

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
        Schema::table('detail_mhs_observasis', function (Blueprint $table) {
            $table->dropForeign(['surat_observasi_id']);
        });

        Schema::dropIfExists('detail_mhs_observasis');
    }
};
