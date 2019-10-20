<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gasto extends Model
{

  use SoftDeletes;

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

  public function usuario()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function empleado()
  {
    return $this->usuario->persona->empleado;
  }
}
