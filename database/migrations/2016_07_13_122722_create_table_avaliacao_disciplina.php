<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAvaliacaoDisciplina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacao_disciplina', function (Blueprint $table) {
            $table->unsignedInteger('avaliacao_id');
            $table->unsignedInteger('disciplina_id');
            $table->foreign('avaliacao_id')->references('id')->on('avaliacaos');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('avaliacao_disciplina');
    }
}
