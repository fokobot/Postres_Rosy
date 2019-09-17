<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $fillable = [
      'proveedor_id', 'valor_total', 'estado_gasto_id', 'fecha',
    ];

    public function estado()
    {
      return $this->belongsTo('App\EstadoGasto');
    }

    public function proveedor()
    {
      return $this->belongsTo('App\Proveedor');
    }

    public function productos()
    {
      return $this->hasMany('App\DetalleGasto');
    }
}
