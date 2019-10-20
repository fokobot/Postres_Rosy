<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    public function tipo_de_documento()
    {
        return $this->belongsTo('App\TipoDeDocumento');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    public function empleado()
    {
        return $this->hasOne('App\Empleado', 'persona_id');
    }

    public function cliente()
    {
        return $this->hasOne('App\Cliente', 'persona_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\User', 'persona_id');
    }
}
