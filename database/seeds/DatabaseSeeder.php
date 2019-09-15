<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(CiudadesTableSeeder::class);
        $this->call(ProductosTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(EstadosVentaTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TiposDeDocumentoTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(GastosTableSeeder::class);
        $this->call(TrabajosTableSeeder::class);
    }
}
