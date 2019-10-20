<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $this->call(TiposDeDocumentoTableSeeder::class);
            $this->call(DepartamentosTableSeeder::class);
            $this->call(CiudadesTableSeeder::class);
            $this->call(ProductosTableSeeder::class);
            $this->call(EstadosGastoTableSeeder::class);
            $this->call(EstadosVentaTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(UsersTableSeeder::class);
            // $this->call(TrabajosTableSeeder::class);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
