<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Cliente;
use App\ProductoVenta;
use App\Producto;
use App\Venta;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveVentaRequest;
use App\Http\Resources\EstadoVentaResource;
use App\Http\Resources\VentaResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = \App\Venta::all()->load('cliente');
        $estados = \App\EstadoVenta::all();
        return response([
            'ventas'       => VentaResource::collection($ventas),
            'estados'      => EstadoVentaResource::collection($estados)
        ]);
    }

    public function estados()
    {
        $estados = \App\EstadoVenta::all();
        return EstadoVentaResource::collection($estados);
    }

    public function show(Venta $venta)
    {
        return new VentaResource($venta);
    }

    public function store(SaveVentaRequest $request)
    {
        DB::beginTransaction();
        try {
            $venta = new Venta;
            $venta->cliente_id                  = $request->cliente;
            $venta->vendedor_id                 = 1; // TODO Auth::user()->id;
            $venta->estado_venta_id             = $request->estado; // TODO fix
            $venta->fecha                       = $request->fecha;
            $venta->direccion                   = $request->direccion;

            $productos = collect(array_map("static::lista_productos", $request->productos));
            $venta->valor_total = $productos->reduce(function ($accum, $item) {
                return $accum + $item->cantidad * $item->valor;
            });
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

    public function destroy(Venta $venta)
    {
        $venta->delete();
        return response()->json(['mensaje' => 'Venta eliminada con éxito.'], Response::HTTP_OK);
    }

    private static function lista_productos($producto)
    {
        $detallecompra                   = new ProductoVenta;
        $detallecompra->producto_id      = $producto['id'];
        $detallecompra->cantidad         = $producto['cantidad'];
        $detallecompra->valor            = Producto::precio($producto['id'], $producto['cantidad']);
        return $detallecompra;
    }
}
