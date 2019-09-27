<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'documento'             => $this->documento,
            'tipo_de_documento'     => $this->tipo_de_documento_id,
            'nombre'                => $this->nombre,
            'apellidos'             => $this->apellidos,
            'barrio'                => $this->barrio,
            'fecha_de_nacimiento'   => $this->fecha_de_nacimiento,
            'direccion'             => $this->direccion,
            'telefono'              => $this->telefono,
            'email'                 => $this->email
        ];
    }
}
