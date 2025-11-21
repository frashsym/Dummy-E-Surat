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
        Schema::create('pimpinans', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Atribut pimpinan
            $table->string('nip')->nullable();
            $table->string('jabatan'); // Kaprodi, Dekan, Wakil Dekan, dsb
            $table->string('wd')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('prodi')->nullable(); // untuk Kaprodi
            $table->string('profile')->nullable(); // profile
            $table->string('ttd')->nullable(); // simpan path file tanda tangan digital

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pimpinans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('pimpinans');
    }
};
