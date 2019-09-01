<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
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
    if($cantidad >= $producto->minimopormayor){
      return $producto->valormayor;
    }
    return $producto->valordetal;
  }
}
