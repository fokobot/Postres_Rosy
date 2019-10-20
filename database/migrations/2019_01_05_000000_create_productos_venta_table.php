<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_venta', function (Blueprint $table) {
            $table->unsignedInteger('producto_id');
            $table->unsignedInteger('venta_id');
            $table->double('valor', 8, 2);
            $table->unsignedInteger('cantidad');
            $table->timestamps();

            $table->unique(['producto_id', 'venta_id']);
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('venta_id')->references('id')->on('ventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_venta');
    }
}
