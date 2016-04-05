<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaosTable extends Migration
{

    public function up()
    {
        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('semestre', 6);
            $table->date('inicio');
            $table->date('termino');

            $table->unsignedInteger('semestre_id');

        });
    }


    public function down()
    {
        Schema::drop('avaliacaos');
    }
}
