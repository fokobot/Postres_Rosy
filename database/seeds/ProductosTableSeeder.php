<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('productos')->insert([
        ['nombre' => 'Postre Napoleon', 'valordetal' => '3000', 'valormayor' => '2000'],
        ['nombre' => 'Postre Tres Leches', 'valordetal' => '3000', 'valormayor' => '2500'],
        ['nombre' => 'Brownies', 'valordetal' => '3000', 'valormayor' => '2000'],
      ]);
    }
}
