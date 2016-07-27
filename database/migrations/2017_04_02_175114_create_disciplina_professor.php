<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinaProfessor extends Migration
{

    public function up()
    {
        Schema::create('disciplina_professor', function (Blueprint $table) {
            $table->unsignedInteger('disciplina_id');
            $table->unsignedInteger('professor_id');
        });
    }

    public function down()
    {
        Schema::drop('disciplina_professor');
    }
}
