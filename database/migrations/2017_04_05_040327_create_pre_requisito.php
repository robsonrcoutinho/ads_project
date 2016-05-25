<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreRequisito extends Migration
{

    public function up()
    {
        Schema::create('pre_requisito', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedInteger('disciplina_id');
            $table->unsignedInteger('pre_requisito_id');
        });
    }

    function down()
    {
        Schema::drop('pre_requisito');
    }
}
