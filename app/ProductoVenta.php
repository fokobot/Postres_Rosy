<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoVenta extends Model
{

  protected $table = 'productos_venta';

  protected $fillable = [
      'producto_id', 'valor', 'cantidad', 'venta_id',
  ];

  public function venta()
  {
    return $this->belongsTo('App\Venta', 'venta_id');
  }

  public function producto()
  {
    return $this->belongsTo('App\Producto', 'producto_id');
  }
}
