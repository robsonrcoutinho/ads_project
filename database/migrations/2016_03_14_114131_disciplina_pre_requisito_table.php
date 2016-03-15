<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DisciplinaPreRequisitoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplina_pre_requisito', function (Blueprint $table) {
            $table->string('disciplina', 6);
            $table->foreign('disciplina')->references('codigo')->on('disciplinas');
            $table->string('pre_requisito', 6);
            $table->foreign('pre_requisito')->references('codigo')->on('disciplinas');
            $table->primary(['disciplina', 'pre_requisito']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('disciplina_pre_requisito');
    }
}
