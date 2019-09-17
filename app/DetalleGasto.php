<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleGasto extends Model
{

    protected $fillable = ['gasto_id', 'producto', 'cantidad', 'valor_unitario'];

    public function gasto()
    {
        return $this->belongsTo('App\Gasto');
    }
}
