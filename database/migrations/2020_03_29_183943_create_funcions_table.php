<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funciones', function (Blueprint $table) {
            $table->increments('codFuncion');
            $table->unsignedInteger('codOpcion');
            $table->string('codRol', 20);
            // $table->timestamps();
            $table->foreign('codOpcion')->references('codOpcion')->on('opciones');
            $table->foreign('codRol')->references('codRol')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funciones');
    }
}
