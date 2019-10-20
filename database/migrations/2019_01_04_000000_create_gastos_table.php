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
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('proveedor_id');
            $table->date('fecha');
            $table->double('valor_total', 12, 2);
            $table->unsignedInteger('estado_gasto_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('estado_gasto_id')->references('id')->on('estados_gasto');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('user_id')->references('id')->on('users');
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
