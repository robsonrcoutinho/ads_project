<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinasTable extends Migration
{

    public function up()
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('codigo', 6)->nullable();
            $table->string('codigo', 6)->unique();
            $table->string('nome', 60);
            $table->integer('carga_horaria');
            $table->string('ementa', 100)->nullable();
            $table->boolean('ativa')->default(true);
            $table->softDeletes();

            $table->unsignedInteger('professor_id');
            $table->unsignedInteger('semestre_id');
            $table->unsignedInteger('disciplina_id');

        });
    }

    public function down()
    {

    }
}
