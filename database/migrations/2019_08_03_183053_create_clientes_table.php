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
            $table->unsignedInteger('tipo_de_documento_id')->nullable();
            $table->string('documento', 20)->nullable();
            $table->string('nombre', 30);
            $table->string('apellidos', 30);
            $table->string('direccion', 30);
            $table->string('barrio', 30);
            $table->string('telefono', 30);
            $table->string('email', 50)->nullable();
            $table->date('fecha_de_nacimiento');
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
