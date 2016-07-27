<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkTable extends Migration
{

    public function up()
    {
        Schema::table('disciplina_professor', function (Blueprint $table) {
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->foreign('professor_id')->references('id')->on('professors');
        });

        Schema::table('disciplina_semestre', function (Blueprint $table) {
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->foreign('semestre_id')->references('id')->on('semestres');
        });

        Schema::table('avaliacaos', function (Blueprint $table) {
            $table->foreign('semestre_id')->references('id')->on('semestres');
        });

        Schema::table('respostas', function (Blueprint $table) {
            $table->foreign('pergunta_id')->references('id')->on('perguntas');
            $table->foreign('avaliacao_id')->references('id')->on('avaliacaos');
        });

        Schema::table('avaliacao_pergunta', function (Blueprint $table) {
            $table->foreign('avaliacao_id')->references('id')->on('avaliacaos');
            $table->foreign('pergunta_id')->references('id')->on('perguntas');
        });

        Schema::table('opcao_resposta', function (Blueprint $table) {
            $table->foreign('pergunta_id')->references('id')->on('perguntas')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('pre_requisito', function (Blueprint $table) {
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pre_requisito_id')->references('id')->on('disciplinas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {

    }
}
