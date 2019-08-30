<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        ['nombre' => 'Luis', 'apellidos' => 'Cárcamo Morales', 'email' => 'luis@gmail.com', 'password' => bcrypt('123456')],
        ['nombre' => 'Fabian', 'apellidos' => 'Osorio Iriarte', 'email' => 'fabian@gmail.com', 'password' => bcrypt('123456')],
      ]);
    }
}
