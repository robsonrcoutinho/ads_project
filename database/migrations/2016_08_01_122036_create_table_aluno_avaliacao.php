<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAlunoAvaliacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_avaliacao', function (Blueprint $table) {
            $table->unsignedInteger('aluno_id');
            $table->unsignedInteger('avaliacao_id');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('avaliacao_id')->references('id')->on('avaliacaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aluno_avaliacao');
    }
}
