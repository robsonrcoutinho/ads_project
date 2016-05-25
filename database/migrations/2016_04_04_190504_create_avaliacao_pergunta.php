<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaoPergunta extends Migration
{

    public function up()
    {
        Schema::create('avaliacao_pergunta', function (Blueprint $table) {
            $table->unsignedInteger('avaliacao_id');
            $table->unsignedInteger('pergunta_id');
        });
    }

    public function down()
    {
        Schema::drop('avaliacao_pergunta');
    }
}
