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
        Schema::create('template_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_surat_id')->constrained('jenis_surats')->cascadeOnDelete();
            $table->string('nama_template');
            $table->string('slug');
            $table->string('kop_surat')->nullable();
            $table->text('body_template');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('template_surats', function (Blueprint $table) {
            $table->dropForeign(['jenis_surat_id']);
        });

        Schema::dropIfExists('template_surats');
    }
};
