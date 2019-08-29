<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $fillable = [
      'descripcion', 'valor', 'estado', 'fecha',
    ];

    public function estado()
    {
      return $this->belongsTo('App\Estado');
    }
}
