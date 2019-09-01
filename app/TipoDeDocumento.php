<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeDocumento extends Model
{
    protected $table = 'tipos_de_documento';

    protected $fillable = [
        'nombre', 'abreviatura'
    ];

    public function clientes()
    {
      return $this->hasMany('App\Cliente', 'tipo_de_documento_id');
    }
}
