<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('semestre', 6);
            $table->date('inicio');
            $table->date('termino');
            $table->timestamps();
            $table->foreign('semestre')->references('codigo')->on('semestres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('avaliacaos');
    }
}
