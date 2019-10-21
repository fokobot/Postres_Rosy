<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    try {
      Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nombre', 60);
        $table->string('email', 50)->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password', 68);
        $table->unsignedInteger('persona_id')->nullable();
        $table->unsignedInteger('role_id')->nullable();
        $table->rememberToken();
        $table->softDeletes();
        $table->timestamps();

        $table->foreign('role_id')->references('id')->on('roles');
        $table->foreign('persona_id')->references('id')->on('personas');
      });
    } catch (\Throwable $th) {
      Schema::dropIfExists('users');
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
    Schema::dropIfExists('users');
  }
}
