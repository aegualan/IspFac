<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectoriales', function (Blueprint $table) {
            $table->increments('codSectorial');
            $table->string('nomSectorial', 80);
            $table->string('codIp', 50);
            $table->unsignedInteger('codDireccion')->nullable();
            //$table->timestamps();
            $table->foreign('codIp')->references('codIp')->on('ips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sectorials');
    }
}
