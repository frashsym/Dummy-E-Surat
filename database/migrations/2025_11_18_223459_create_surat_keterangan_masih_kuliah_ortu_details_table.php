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
        Schema::create('surat_keterangan_masih_kuliah_ortu_details', function (Blueprint $table) {
            $table->id();

            // FK ke transaksi surat
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

            // Kolom-kolom sesuai kebutuhan
            $table->string('nama_dosen');
            $table->string('nidn')->nullable();
            $table->string('jabatan_dosen')->nullable();
            $table->string('pada_perguruan_tinggi')->nullable();

            $table->string('nama_mhs');
            $table->string('npm');
            $table->string('tk_semester');
            $table->string('prodi');
            $table->string('thn_akademik');
            $table->string('no_hp')->nullable();

            $table->string('nama_ortu');
            $table->string('nip_nrp_nik')->nullable();
            $table->string('pangkat_gol_ruang')->nullable();
            $table->string('instansi_perusahaan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_keterangan_masih_kuliah_ortu_details', function (Blueprint $table) {
            $table->dropForeign(['ts_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('surat_keterangan_masih_kuliah_ortu_details');
    }
};
