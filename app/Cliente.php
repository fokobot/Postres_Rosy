<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'tipo_de_documento', 'documento', 'nombre', 'apellidos', 'direccion', 'ciudad', 'telefono', 'celular'
    ];

    public function nombre_completo()
    {
      return $this->nombre . ' ' . $this->apellidos;
    }

    public function tipo_de_documento()
    {
    	return $this->belongsTo('App\TipoDeDocumento');
    }
}
