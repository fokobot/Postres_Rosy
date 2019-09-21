<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre', 'apellidos', 'direccion', 'barrio', 'telefono', 'nacimiento'
    ];

    public function nombre_completo()
    {
      return $this->nombre . ' ' . $this->apellidos;
    }

    public function compras(){
        return $this->hasMany('App\Venta', 'cliente_id');
    }
}
