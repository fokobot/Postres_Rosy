<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->string('direccion', 40)->nullable();
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('vendedor_id');
            $table->double('valor_total', 12, 2)->default(0.0);
            $table->unsignedInteger('estado_venta_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('vendedor_id')->references('id')->on('users');
            $table->foreign('estado_venta_id')->references('id')->on('estados_venta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
