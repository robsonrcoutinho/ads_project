<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRespostas extends Migration
{

    public function up()
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('campo_resposta');
            $table->unsignedInteger('pergunta_id');
            $table->unsignedInteger('avaliacao_id');
            $table->unsignedInteger('disciplina_id');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });
    }

    public function down()
    {
        Schema::drop('respostas');
    }
}
