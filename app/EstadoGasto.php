<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoGasto extends Model
{
    protected $table = 'estados_gasto';

    protected $fillable = [
      'nombre',
    ];

    public function gastos()
    {
        return $this->hasMany('App\Gasto');
    }
}
