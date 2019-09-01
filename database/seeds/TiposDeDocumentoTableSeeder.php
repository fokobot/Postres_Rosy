<?php

use Illuminate\Database\Seeder;

class TiposDeDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_de_documento')->insert([
        	['nombre' => 'Cédula de Ciudadanía', 'abreviatura'  => 'CC'],
        	['nombre' => 'Tarjeta de Identidad', 'abreviatura'  => 'TI'],
        ]);
    }
}
