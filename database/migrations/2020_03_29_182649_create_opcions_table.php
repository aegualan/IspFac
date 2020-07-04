<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opciones', function (Blueprint $table) {
            $table->increments('codOpcion');
            $table->string('nomOpcion', 50);
            $table->string('urlWeb', 20)->nullable()->unique;
            $table->string('urlAPP', 20)->nullable()->unique;
            $table->integer('ordOpcion');
            $table->unsignedInteger('codMenu');
            // $table->timestamps();
            $table->foreign('codMenu')->references('codMenu')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opciones');
    }
}
