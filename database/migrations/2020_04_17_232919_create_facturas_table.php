<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->string('codFactura', 100)->primary();
            $table->dateTime("fecPagFactura");
            $table->dateTime("fecGenFactura");
            $table->decimal('totFactura', 10, 2);
            $table->string('estFactura', 5);
            $table->string('obsFactura', 100);
            $table->string('codContrato', 50);
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
        Schema::dropIfExists('facturas');
    }
}
