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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();

            // Relasi ke users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Atribut dosen
            $table->string('nip')->nullable();
            $table->string('nidn')->nullable();
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('jabatan_fungsional')->nullable(); // Lektor, AA, dll
            $table->string('pangkat_golongan')->nullable(); // III/a, III/b, dll
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('profile')->nullable(); // profile
            $table->string('ttd')->nullable(); // path file tanda tangan

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('dosens');
    }
};
