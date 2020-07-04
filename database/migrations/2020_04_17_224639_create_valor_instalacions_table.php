<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorInstalacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valorInstalaciones', function (Blueprint $table) {
            $table->increments('codValInstalacion');
            $table->decimal('valTotValInstalacion', 10, 2);
            $table->decimal('aboValInstalacion', 10, 2);
            $table->decimal('salValInstalacion', 10, 2);
            $table->integer('nroCuoValInstalacion');
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
        Schema::dropIfExists('valorInstalaciones');
    }
}
