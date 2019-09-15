<?php

use Illuminate\Database\Seeder;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->insert([
		['nombre' =>  'Amazonas'],
		['nombre' =>  'Antioquia'],
		['nombre' =>  'Arauca'],
		['nombre' =>  'Atlántico'],
		['nombre' =>  'Bolívar'],
		['nombre' =>  'Boyacá'],
		['nombre' =>  'Caldas'],
		['nombre' =>  'Caquetá'],
		['nombre' =>  'Casanare'],
		['nombre' =>  'Cauca'],
		['nombre' =>  'Cesar'],
		['nombre' =>  'Chocó'],
		['nombre' =>  'Córdoba'],
		['nombre' =>  'Cundinamarca'],
		['nombre' =>  'Güainia'],
		['nombre' =>  'Guaviare'],
		['nombre' =>  'Huila'],
		['nombre' =>  'La Guajira'],
		['nombre' =>  'Magdalena'],
		['nombre' =>  'Meta'],
		['nombre' =>  'Nariño'],
		['nombre' =>  'Norte de Santander'],
		['nombre' =>  'Putumayo'],
		['nombre' =>  'Quindio'],
		['nombre' =>  'Risaralda'],
		['nombre' =>  'San Andrés y Providencia'],
		['nombre' =>  'Santander'],
		['nombre' =>  'Sucre'],
		['nombre' =>  'Tolima'],
		['nombre' =>  'Valle del Cauca'],
		['nombre' =>  'Vaupés'],
		['nombre' =>  'Vichada']
		]);
    }
}
