<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      ['id' => 1, 'nombre' => 'System', 'email' => 'system@postresrosy.com', 'password' => bcrypt('123456789'), 'role_id' => 1, 'persona_id' => null],
      ['id' => 2, 'nombre' => 'Administrador', 'email' => 'admin@postresrosy.com', 'password' => bcrypt('123456789'), 'role_id' => 2, 'persona_id' => null],
    ]);
  }
}
