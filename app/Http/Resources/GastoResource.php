<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GastoResource extends JsonResource
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
            'proveedor_id'  => $this->proveedor_id,
            'proveedor'     => new ProveedorResource($this->proveedor),
            'empleado'      => new UserResource($this->empleado),
            'fecha'         => $this->fecha,
            'total'         => $this->valor_total,
            'estado'        => $this->estado_gasto_id,
            'productos'     => ProductoGastoResource::collection($this->productos)
        ];
    }
}
