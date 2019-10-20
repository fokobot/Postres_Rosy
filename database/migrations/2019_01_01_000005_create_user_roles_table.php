<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    try {
      Schema::create('user_roles', function (Blueprint $table) {
        $table->unsignedInteger('role_id');
        $table->unsignedInteger('user_id');
        $table->unique(['role_id', 'user_id']);
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('role_id')->references('id')->on('roles');
      });
    } catch (\Throwable $th) {
      Schema::dropIfExists('user_roles');
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
    Schema::dropIfExists('user_roles');
  }
}
