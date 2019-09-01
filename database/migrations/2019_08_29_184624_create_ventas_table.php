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
            $table->bigIncrements('id');
            $table->integer('tipo_de_documento');
            $table->string('documento', 30);
            $table->string('nombre', 30);
            $table->string('apellidos', 30);
            $table->string('direccion', 30);
            $table->string('ciudad', 50);
            $table->string('telefono', 30);
            $table->string('celular', 30);
            //$table->unsignedBigInteger('cliente_id');
            //$table->unsignedBigInteger('vendedor_id');
            //$table->double('costo_domicilio', 8, 2);
            //$table->string('direccion_domicilio', 30);
            $table->double('valor_total', 8, 2);
            $table->unsignedInteger('estado_venta_id');
            //$table->datetime('fecha');
            $table->timestamps();

            //$table->foreign('cliente_id')->references('id')->on('clientes');
            //$table->foreign('vendedor_id')->references('id')->on('users');
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
