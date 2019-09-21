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
use Illuminate\Http\Response;

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
            $cliente                          = new Cliente;
            $cliente->nombre                  = $request->nombre;
            $cliente->apellidos               = $request->apellidos;
            $cliente->direccion               = $request->direccion;
            $cliente->barrio                  = $request->barrio;
            $cliente->telefono                = $request->telefono;
            $cliente->nacimiento              = $request->nacimiento;
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

    public function destroy(Venta $venta)
    {
      $venta->delete();
      return response()->json(['mensaje' => 'Venta eliminada con éxito.'], Response::HTTP_OK);
    }

    private static function lista_productos($producto){
        $detallecompra                   = new ProductoVenta;
        $detallecompra->producto_id      = $producto['id'];
        $detallecompra->cantidad         = $producto['cantidad'];
        $detallecompra->valor            = Producto::precio($producto['id'], $producto['cantidad']);
        return $detallecompra;
    }
}
