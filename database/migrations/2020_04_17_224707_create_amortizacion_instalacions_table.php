<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmortizacionInstalacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amortizacionInstalaciones', function (Blueprint $table) {
            $table->increments('codAmoInstalacion');
            $table->timestamp("fecPagAmoInstalacion")->nullable();
            $table->decimal('valCuoAmoInstalacion', 10, 2);
            $table->decimal('salValAmoInstalacion', 10, 2);
            $table->integer('nroCuoAmoInstalacion');
            $table->string('estAmoInstalacion', 5);
            $table->unsignedInteger('codValInstalacion');
            $table->foreign('codValInstalacion')->references('codValInstalacion')->on('valorInstalaciones');
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
        Schema::dropIfExists('amortizacionInstalaciones');
    }
}
