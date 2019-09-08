<?php

use Illuminate\Database\Seeder;

class GastosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $gastos = factory(App\Gasto::class, 50)->create();
    }
}
