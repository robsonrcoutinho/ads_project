<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('avisos', function (Blueprint $table) {
            $table->increments('id');
            $table->String('titulo',20);
            $table->String('mensagem', 255);
            $table->timestamps();
        $table->renameColumn('idAviso','id');
        });*/
        Schema::table('avisos', function (Blueprint $table) {
            //$table->increments('id');
            //$table->String('titulo',20);
            //$table->String('mensagem', 255);
            //$table->timestamps();
            $table->renameColumn('idAviso','id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('avisos');
    }
}
