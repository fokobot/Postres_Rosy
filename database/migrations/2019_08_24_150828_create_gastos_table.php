<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->date('fecha');
            $table->double('valor_total', 10, 2);
            $table->unsignedBigInteger('estado_gasto_id');
            $table->timestamps();

            $table->foreign('estado_gasto_id')->references('id')->on('estados_gasto');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            // TODO REFERENCES EMPLEADOS
            $table->foreign('empleado_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos');
    }
}
