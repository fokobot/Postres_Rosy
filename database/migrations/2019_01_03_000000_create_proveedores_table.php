<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social', 30);
            $table->string('telefono', 30);
            $table->string('direccion', 30);
            $table->unsignedInteger('ciudad_id');
            $table->string('gerente', 50);
            $table->string('email', 50);
            $table->string('edad_rc', 20);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ciudad_id')->references('id')->on('ciudades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
