<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    try {
      Schema::create('personas', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('tipo_de_documento_id')->nullable();
        $table->string('documento', 20)->nullable();
        $table->string('nombre', 30);
        $table->string('apellidos', 30)->nullable();
        $table->unsignedInteger('ciudad_id')->nullable();
        $table->string('direccion', 30);
        $table->string('barrio', 30);
        $table->string('telefono', 30)->nullable();
        $table->string('celular', 30)->nullable();
        $table->date('fecha_de_nacimiento')->nullable();
        $table->softDeletes();
        $table->timestamps();

        $table->foreign('tipo_de_documento_id')->references('id')->on('tipos_de_documento');
        $table->foreign('ciudad_id')->references('id')->on('ciudades');
      });
    } catch (\Throwable $th) {
      Schema::dropIfExists('personas');
      throw $th;
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('personas');
  }
}
