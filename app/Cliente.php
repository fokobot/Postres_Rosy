<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre', 'direccion', 'ciudad', 'telefono',
    ];
}
