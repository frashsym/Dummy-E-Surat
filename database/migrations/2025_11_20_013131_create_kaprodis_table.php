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
        Schema::create('kaprodis', function (Blueprint $table) {
            $table->id();

            // Relasi ke users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Atribut Kaprodi
            $table->string('nip')->nullable();
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('ttd')->nullable(); // path tanda tangan digital

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('kaprodis', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('kaprodis');
    }

};
