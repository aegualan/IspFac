<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('codPersona', 20)->primary();
            $table->string('apePersona', 80);
            $table->string('nomPersona', 80);
            $table->string('telPersona', 20)->nullable();
            $table->string('celPersona', 20)->nullable();
            $table->string('emaPersona', 80)->nullable();
            $table->string('codRol', 20);
            // $table->timestamps();
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
        Schema::dropIfExists('personas');
    }

}
