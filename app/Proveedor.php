<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;

    protected $table = 'proveedores';

    public function materias_primas()
    {
        return $this->hasMany('App\MateriaPrima', 'proveedor_id');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad', 'ciudad_id');
    }
}
