<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePerguntas extends Migration
{

    public function up()
    {
        Schema::create('perguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enunciado');
            $table->boolean('pergunta_fechada')->default(false);
            $table->softDeletes();
        });
    }

    public function down()
    {
        //Schema::drop('perguntas');
    }
}
