<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosCivilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_civiles')->insert([
            ['id' => 1, 'nombre' => 'Soltero']
        ]);
    }
}
