<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestresTable extends Migration
{

    public function up()
    {
        Schema::create('semestres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 6)->nullable();
            $table->date('inicio');
            $table->date('termino');
            $table->unsignedInteger('disciplina_id');

        });
    }


    public function down()
    {

    }
}
