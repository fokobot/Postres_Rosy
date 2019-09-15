<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{

    protected $table = "proveedores";

    public function materias_primas()
    {
        return $this->hasMany('App\MateriaPrima', 'proveedor_id');
    }
}
