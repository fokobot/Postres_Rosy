<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProveedorResource extends JsonResource
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
          'razon_social' => $this->razon_social,
          'gerente'      => $this->gerente,
          'email'        => $this->email,
          'ciudad'       => $this->ciudad,
          'direccion'    => $this->direccion,
          'telefono'     => $this->telefono,
          'edad_rc'      => $this->edad_rc,
        ];
    }
}
