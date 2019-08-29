<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombres', 'apellidos', 'direccion', 'ciudad', 'telefono',
    ];

    public function nombre_completo()
    {
      return $this->nombres . ' ' . $this->apellidos;
    }
}
