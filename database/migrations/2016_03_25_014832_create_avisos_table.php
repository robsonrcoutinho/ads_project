<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisosTable extends Migration
{

    public function up()
    {
        Schema::create('avisos', function (Blueprint $table) {
            $table->increments('id');
            $table->String('titulo',20);
            $table->text('mensagem');
            $table->timestamp();
        });
    }

    public function down()
    {
        Schema::drop('avisos');
    }
}
