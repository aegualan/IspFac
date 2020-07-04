<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->string('codContrato', 50)->primary(); //numero contrato
            $table->timestamp("fecContrato")->nullable();
            $table->integer('estContrato');
            $table->string('codPersona', 20);
            $table->string('codPlan', 20);
            $table->string('codIp', 50);
            $table->unsignedInteger('codDireccion')->nullable();
            $table->unsignedInteger('codValInstalacion');
            //$table->timestamps();
            $table->foreign('codPersona')->references('codPersona')->on('personas');
            // $table->foreign('codPlan')->references('codPlan')->on('planes');
            $table->foreign('codIp')->references('codIp')->on('ips');
            // $table->foreign('codValInstalacion')->references('codValInstalacion')->on('valorInstalaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }

}
