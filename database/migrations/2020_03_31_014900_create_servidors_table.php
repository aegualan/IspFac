<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servidores', function (Blueprint $table) {
            $table->string('codServidor', 20)->primary();
            $table->string('nomServidor', 50);
            $table->string('ipServidor', 50);
            $table->string('userServidor', 50);
            $table->string('passServidor', 50)->nullable();
            $table->string('portServidor', 4)->nullable();
            $table->string('intLanServidor', 20);
            $table->string('ranIpServidor', 50);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servidores');
    }
}
