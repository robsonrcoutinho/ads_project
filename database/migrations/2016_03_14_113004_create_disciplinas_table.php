<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinasTable extends Migration
{

    public function up()
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 6)->unique();
            $table->string('nome', 60);
            $table->integer('carga_horaria');
            $table->string('ementa', 255)->nullable();
            $table->string('plano_ensino', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('disciplinas');
    }
}
