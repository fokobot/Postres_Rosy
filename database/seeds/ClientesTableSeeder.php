<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('clientes')->insert([
        ['tipo_de_documento_id' => '1', 'documento' => '1234', 'nombre' => 'Fabian', 'apellidos' => 'Osorio Iriarte', 'direccion' => 'Avenida Siempre Viva', 'ciudad' => 'Barranquilla', 'telefono' => '3654368', 'celular' => '3001234567'],
        ['tipo_de_documento_id' => '1', 'documento' => '1235', 'nombre' => 'Luis', 'apellidos' => 'Cárcamo Morales', 'direccion' => 'Avenida Siempre Viva 2', 'ciudad' => 'Barranquilla', 'telefono' => '3654368', 'celular' => '3009876543'],
      ]);
    }
}
