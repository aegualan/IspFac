<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleFacturas', function (Blueprint $table) {
            $table->increments('codDetFactura');
            $table->integer('canDetFactura');
            $table->string('desDetFactura', 100);
            $table->decimal('valUniDetFactura', 10, 2);
            $table->integer('descDetFactura');
            $table->string('codFactura', 100);
            //  $table->foreign('codFactura')->references('codFactura')->on('facturas');
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
        Schema::dropIfExists('detalleFacturas');
    }
}
