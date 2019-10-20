<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriasPrimasProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias_primas_proveedor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 30);
            $table->unsignedInteger('proveedor_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('proveedor_id')->references('id')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias_primas_proveedor');
    }
}
