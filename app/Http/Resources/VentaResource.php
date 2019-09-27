<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VentaResource extends JsonResource
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
            'id'        => $this->id,
            'cliente'   => new ClienteResource($this->cliente),
            'vendedor'  => new UserResource($this->vendedor),
            'total'     => $this->valor_total,
            'productos' => ProductosVentaResource::collection($this->productos),
            'estado'    => $this->estado_venta_id,
            'fecha'     => $this->fecha
        ];
    }
}
