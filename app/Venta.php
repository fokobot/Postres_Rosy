<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function cliente()
    {
      return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    public function vendedor()
    {
      return $this->belongsTo('App\User', 'vendedor_id');
    }

    public function estado()
    {
      return $this->belongsTo('App\EstadoVenta', 'estado_venta_id');
    }

    public function productos()
    {
      return $this->hasMany('App\ProductoVenta', 'venta_id');
    }
}
