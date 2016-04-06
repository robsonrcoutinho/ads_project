<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpcaoResposta extends Migration
{

    public function up()
    {
        Schema::create('opcao_resposta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resposta_opcao');

            $table->unsignedInteger('pergunta_id');

        });
    }


    public function down()
    {

    }
}
