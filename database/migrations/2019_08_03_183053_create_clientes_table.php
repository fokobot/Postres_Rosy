<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('tipo_de_documento_id');
            $table->string('documento', 30);
            $table->string('nombre', 30);
            $table->string('apellidos', 30);
            $table->string('direccion', 100);
            $table->string('ciudad', 50);
            $table->string('telefono', 30);
            $table->string('celular', 30);
            $table->timestamps();

            $table->foreign('tipo_de_documento_id')->references('id')->on('tipos_de_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
