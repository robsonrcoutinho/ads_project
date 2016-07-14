<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorsTable extends Migration
{

    public function up()
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matricula', 6)->unique();
            $table->string('nome', 60);
            $table->string('email', 100);
            $table->string('curriculo', 100)->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('professors');
    }
}
