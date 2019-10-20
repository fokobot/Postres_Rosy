<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonaResource extends JsonResource
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
      'id'                  => $this->id,
      'tipo_de_documento'   => $this->tipo_de_documento,
      'documento'           => $this->documento,
      'nombre'              => $this->nombre,
      'apellidos'           => $this->apellidos,
      'ciudad'              => $this->ciudad,
      'direccion'           => $this->direccion,
      'barrio'              => $this->barrio,
      'telefono'            => $this->telefono,
      'celular'             => $this->celular,
      'fecha_de_nacimiento' => $this->fecha_de_nacimiento,
    ];
  }
}
