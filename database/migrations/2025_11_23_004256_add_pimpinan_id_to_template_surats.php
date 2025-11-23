<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('template_surats', function (Blueprint $table) {
            if (!Schema::hasColumn('template_surats', 'pimpinan_id')) {
                $table->unsignedBigInteger('pimpinan_id')->nullable()->after('body_template');
            }

            $table->foreign('pimpinan_id')
                ->references('id')
                ->on('pimpinans')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('template_surats', function (Blueprint $table) {
            $table->dropForeign(['pimpinan_id']);
            $table->dropColumn('pimpinan_id');
        });
    }
};
