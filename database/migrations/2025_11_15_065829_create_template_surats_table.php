<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateSuratsTable extends Migration
{
    public function up()
    {
        Schema::create('template_surats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_template'); // nama jenis surat
            $table->text('html_template');   // struktur HTML template surat
            $table->json('editable_fields'); // field mana saja yang bisa di-edit
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('template_surats');
    }
}
