<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriaPrimaProveedor extends Model
{
    use SoftDeletes;

    protected $table = "materias_primas_proveedor";

    protected $fillable = ['nombre', 'proveedor_id'];
}
