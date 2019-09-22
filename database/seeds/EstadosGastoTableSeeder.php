<?php

use Illuminate\Database\Seeder;

class EstadosGastoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_gasto')->insert([
          ['nombre' => 'Pendiente', 'color' => 'warning'],
          ['nombre' => 'Pago',      'color' => 'success'],
        ]);
    }
}
