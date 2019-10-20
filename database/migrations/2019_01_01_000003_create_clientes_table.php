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
    try {
      Schema::create('clientes', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('persona_id');
        $table->string('email', 50)->nullable();
        $table->unsignedInteger('estrato_social')->nullable();
        $table->softDeletes();
        $table->timestamps();

        $table->foreign('persona_id')->references('id')->on('personas');
      });
    } catch (\Throwable $th) {
      Schema::dropIfExists('clientes');
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
    Schema::dropIfExists('clientes');
  }
}
