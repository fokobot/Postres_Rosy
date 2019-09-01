<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
  protected $fillable = [
      'producto_nombre', 'valor', 'cantidad', 'venta_id',
  ];

  public function compra()
  {
    return $this->belongsTo('App\Venta', 'venta_id');
  }

  public function producto()
  {
    return $this->belongsTo('App\DetalleCompra', 'producto_id');
  }
}
