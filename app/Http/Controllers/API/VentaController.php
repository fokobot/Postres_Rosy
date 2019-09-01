<?php

namespace App\Http\Controllers\API;

use App\Venta;
use Illuminate\Http\Request;
use App\Http\Requests\SaveVentaRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\DetalleCompra;
use App\Producto;
use Auth;

class VentaController extends Controller
{
    public function store(SaveVentaRequest $request)
    {
        DB::beginTransaction();
        $venta                             = new Venta;
        $venta->tipo_de_documento          = $request->tipo_de_documento;
        $venta->documento                  = $request->documento;
        $venta->nombre                     = $request->nombre;
        $venta->apellidos                  = $request->apellidos;
        $venta->direccion                  = $request->direccion;
        $venta->ciudad                     = $request->ciudad;
        $venta->telefono                   = $request->telefono;
        $venta->celular                    = $request->celular;
        //$venta->vendedor_id                = Auth::user()->id;
        $venta->estado_venta_id            = 1;
        $venta->valor_total                = 0;
        foreach ($request->productos as $producto){
          $detallecompra                   = new DetalleCompra;
          $detallecompra->producto_id      = $producto['id'];
          $detallecompra->cantidad         = $producto['cantidad'];
          $detallecompra->valor            = Producto::precio($producto['id'],$producto['cantidad']);
          $detallecompra->save();
          $venta->valor_total              += $detallecompra->cantidad * $detallecompra->valor;
        }
        $venta->save();
        //DetalleCompra::insert($detallecompras);
        DB::commit();
        //session()->flash('success', 'Venta creada con éxito');
        //return redirect()->route('ventas.index');
        return response()->json($request->all());
    }
}
