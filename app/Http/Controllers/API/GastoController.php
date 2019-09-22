<?php

namespace App\Http\Controllers\API;

use App\DetalleGasto;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveGastoRequest;
use App\Gasto;
use App\Http\Resources\EstadoGastoResource;
use App\Http\Resources\GastoResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GastoController extends Controller
{
  public function index()
  {
    $gastos = Gasto::all();
    $estados = \App\EstadoGasto::all();
    return response([
      'gastos'       => GastoResource::collection($gastos),
      'estados'      => EstadoGastoResource::collection($estados)
    ]);
  }

  public function show(Gasto $gasto)
  {
    return new GastoResource($gasto);
  }

  public function store(SaveGastoRequest $request)
  {
    DB::beginTransaction();
    try {
      $gasto = new Gasto;
      $gasto->proveedor_id          = $request->proveedor;
      $gasto->fecha                 = $request->fecha;
      $gasto->estado_gasto_id       = $request->estado;
      $gasto->valor_total           = 0;
      // TODO Verificar si este ArrayMap es necesario.
      $productos = array_map('static::lista_productos', $request->productos);
      $gasto->save();
      $gasto->productos()->saveMany($productos);
      DB::commit();
      return response()->json([
          'mensaje' => 'Gasto registrado con éxito.'
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      DB::rollback();
      return response()->json([
          'mensaje' => 'Error al crear el registro de gasto.'
      ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }

  private static function lista_productos($producto){
    $detallegasto                   = new DetalleGasto;
    $detallegasto->producto         = $producto['nombre'];
    $detallegasto->cantidad         = $producto['cantidad'];
    $detallegasto->valor_unitario   = $producto['valor'];
    return $detallegasto;
  }

  public function update(SaveGastoRequest $request, Gasto $gasto)
  {
    $gasto->descripcion           = $request->descripcion;
    $gasto->valor                 = $request->valor;
    $gasto->estado_id             = $request->estado_id;
    $gasto->fecha                 = $request->fecha;
    $gasto->save();
    return response()->json(['mensaje' => 'Gasto editado con éxito.'], Response::HTTP_OK);
  }

  public function destroy(Gasto $gasto)
  {
    $gasto->delete();
    return response()->json(['mensaje' => 'Gasto eliminado con éxito.'], Response::HTTP_OK);
  }

}
