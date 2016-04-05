<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreRequisito extends Migration
{

    public function up()
    {
        Schema::create('pre_requisito', function (Blueprint $table) {
            $table->unsignedInteger('disciplina_id');
            $table->unsignedInteger('possui_codigo_disciplina');
        });
    }

     function down()
    {

    }
}
