<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Cliente;
use App\ProductoVenta;
use App\Producto;
use App\Venta;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveVentaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
      $ventas = \App\Venta::all()->load('cliente');
      $estados = \App\EstadoVenta::all();
      return response()->json([
        'ventas'       => $ventas,
        'estados'      => $estados
      ]);
    }

    public function store(SaveVentaRequest $request)
    {
        DB::beginTransaction();
        try {
            $cliente                             = new Cliente;
            $cliente->tipo_de_documento_id       = $request->tipo_de_documento;
            $cliente->documento                  = $request->documento;
            $cliente->nombre                     = $request->nombre;
            $cliente->apellidos                  = $request->apellidos;
            $cliente->direccion                  = $request->direccion;
            $cliente->ciudad                     = $request->ciudad;
            $cliente->telefono                   = $request->telefono;
            $cliente->celular                    = $request->celular;
            $cliente->save();

            $venta = new Venta;
            $venta->cliente_id                  = $cliente->id;
            $venta->vendedor_id                 = 1;//Auth::user()->id;
            $venta->estado_venta_id             = 1;
            $venta->valor_total                 = 0;

            $productos = array_map("static::lista_productos", $request->productos);
            $venta->save();
            $venta->productos()->saveMany($productos);
            DB::commit();
            return response()->json([
                'mensaje' => 'Venta creada con éxito.'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'mensaje' => 'Error al crear la venta.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    private static function lista_productos($producto){
        $detallecompra                   = new ProductoVenta;
        $detallecompra->producto_id      = $producto['id'];
        $detallecompra->cantidad         = $producto['cantidad'];
        $detallecompra->valor            = Producto::precio($producto['id'], $producto['cantidad']);
        return $detallecompra;
    }
}
