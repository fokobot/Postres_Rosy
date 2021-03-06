<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
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
            'id'           => $this->id,
            'conyuge'      => $this->conyuge,
            'estado_civil' => $this->estado_civil,
            'persona'      => new PersonaResource($this->persona),
            'email'        => $this->persona->usuario->email
        ];
    }
}
