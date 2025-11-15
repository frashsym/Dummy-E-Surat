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
        Schema::table('users', function (Blueprint $table) {
            // tambah kolom role_id setelah id (opsional)
            $table->unsignedBigInteger('role_id')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // hapus foreign key dan kolom
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
