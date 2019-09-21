<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'tipo_de_documento', 'documento', 'nombres', 'apellidos', 'direccion', 'barrio', 'telefono', 'ocupacion'
    ];

    public function tipo_de_documento()
    {
    	return $this->belongsTo('App\TipoDeDocumento');
    }
}
