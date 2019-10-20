<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{

    use SoftDeletes;

    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }

    public function compras()
    {
        return $this->hasMany('App\Venta', 'cliente_id');
    }
}
