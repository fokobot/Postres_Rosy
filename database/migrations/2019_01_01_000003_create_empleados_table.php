<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('persona_id');
            $table->string('conyuge', 30)->nullable();
            $table->unsignedInteger('estado_civil_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('estado_civil_id')->references('id')->on('estados_civiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
