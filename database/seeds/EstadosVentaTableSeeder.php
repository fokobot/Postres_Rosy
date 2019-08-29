<?php

use Illuminate\Database\Seeder;

class EstadosVentaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('estados_venta')->insert([
        ['nombre' => 'Pendiente', 'color'  => 'warning'],
        ['nombre' => 'Cancelada', 'color'   => 'danger'],
        ['nombre' => 'Finalizada', 'color'  => 'success'],
      ]);
    }
}
