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
        Schema::table('surats', function (Blueprint $table) {
            // relasi ke template surat
            $table->foreignId('template_id')->after('id')->constrained('template_surats')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            // hapus foreign key dan kolom
            $table->dropForeign(['template_id']);
            $table->dropColumn('template_id');
        });
    }
};
