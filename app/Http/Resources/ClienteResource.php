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
            'id'            => $this->id,
            'nombre'        => $this->nombre,
            'apellidos'     => $this->apellidos,
            'barrio'        => $this->barrio,
            'nacimiento'    => $this->nacimiento,
            'direccion'     => $this->direccion,
            'telefono'      => $this->telefono,
        ];
    }
}
