<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre', 'apellidos', 'direccion', 'ciudad', 'telefono',
    ];

    public function nombre_completo()
    {
      return $this->nombre . ' ' . $this->apellidos;
    }
}
