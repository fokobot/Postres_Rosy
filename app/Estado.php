<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = [
      'nombre',
    ];

    public function gastos()
    {
        return $this->hasMany('App\Gasto');
    }
}
