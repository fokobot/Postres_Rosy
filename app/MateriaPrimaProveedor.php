<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaPrimaProveedor extends Model
{
    protected $table = "materias_primas_proveedor";

    protected $fillable = ['nombre', 'proveedor_id'];
}
