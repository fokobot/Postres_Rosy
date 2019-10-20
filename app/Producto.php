<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'nombre', 'valordetal', 'valormayor', 'minimopormayor',
  ];

  public function detalles()
  {
    return $this->hasMany('App\DetalleCompra', 'producto_id');
  }

  public static function precio($id, $cantidad)
  {
    $producto = static::find($id);
    if ($cantidad >= $producto->minimopormayor) {
      return $producto->valormayor;
    }
    return $producto->valordetal;
  }

  public function ventas()
  {
    return $this->hasMany('App\ProductoVenta', 'producto_id');
  }
}
