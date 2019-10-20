<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;

    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }

    public function estado_civil()
    {
        return $this->belongsTo('App\EstadoCivil');
    }
}
