<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gasto_id');
            $table->string('producto', 40);
            $table->double('cantidad', 8, 2);
            $table->double('valor_unitario', 10, 2);
            $table->timestamps();

            $table->foreign('gasto_id')->references('id')->on('gastos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_gastos');
    }
}
