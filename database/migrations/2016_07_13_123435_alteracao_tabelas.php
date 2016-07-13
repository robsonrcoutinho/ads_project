<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteracaoTabelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('professors', function (Blueprint $table) {
            //Adicionando campo email a tabela professors
            $table->string('email', 100)->nullable();
            //Alterando tamanho do campo nome da tabela professors
            $table->string('nome', 60)->change();
        });

        Schema::table('alunos', function (Blueprint $table) {
            //Alterando tamanho do campo nome da tabela professors
            $table->string('nome', 60)->change();
        });

        Schema::table('avisos', function (Blueprint $table) {
            //Alterando tamanho do campo name da tabela users
            $table->text('mensagem')->change();
        });

        Schema::table('respostas', function (Blueprint $table) {
            //Acrescentando id de disciplina na tabela respostas
            $table->unsignedInteger('disciplina_id')->nullable();
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
        //
    }
}
