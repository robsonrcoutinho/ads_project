<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{

    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 50);
            $table->string('url', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('documentos');
    }
}
