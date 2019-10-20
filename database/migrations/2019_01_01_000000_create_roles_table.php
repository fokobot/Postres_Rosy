<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    try {
      Schema::create('roles', function (Blueprint $table) {
        $table->increments('id');
        $table->string('slug', 20)->unique();
        $table->string('nombre', 30);
        $table->softDeletes();
        $table->timestamps();
      });
    } catch (\Throwable $th) {
      Schema::dropIfExists('roles');
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
    Schema::dropIfExists('roles');
  }
}
