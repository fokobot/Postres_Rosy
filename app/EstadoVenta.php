<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoVenta extends Model
{
    protected $table = 'estados_venta';
    
    public function ventas()
    {
      return $this->hasMany('App\Venta', 'estado_venta_id');
    }
}
