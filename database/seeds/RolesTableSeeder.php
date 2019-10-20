<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'slug' => 'system',   'nombre' => 'Sistema'],
            ['id' => 2, 'slug' => 'admin',    'nombre' => 'Administrador'],
            ['id' => 3, 'slug' => 'vendedor', 'nombre' => 'Vendedor'],
        ]);
    }
}
