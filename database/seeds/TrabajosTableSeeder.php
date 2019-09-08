<?php

use Illuminate\Database\Seeder;

class TrabajosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trabajos = factory(App\Trabajo::class, 50)->create();
    }
}
