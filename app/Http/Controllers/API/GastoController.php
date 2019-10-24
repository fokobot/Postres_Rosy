<?php

namespace App\Http\Controllers\API;

use App\DetalleGasto;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveGastoRequest;
use App\Gasto;
use App\Http\Resources\EstadoGastoResource;
use App\Http\Resources\GastoResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GastoController extends Controller
{
  public function index()
  {
    $gastos = Gasto::all();
    $estados = \App\EstadoGasto::all();
    return GastoResource::collection($gastos);
  }

  public function show(Gasto $gasto)
  {
    return new GastoResource($gasto);
  }

  public function store(SaveGastoRequest $request)
  {
    DB::beginTransaction();
    try {
      $gasto                  = new Gasto;
      $gasto->proveedor_id    = $request->proveedor;
      $gasto->fecha           = $request->fecha;
      $gasto->estado_gasto_id = $request->estado;
      $gasto->user_id         = Auth::user()->id;
      $productos = [];
      $total = 0;
      // TODO corregir
      // SE ESTÁ SUPONIENDO QUE NO HAY TUPLA <PRODUCTO, CANTIDAD> repetida
      for ($i = 0; $i < sizeof($request->productos); $i++) {
        $productos[$i]                   = new DetalleGasto;
        $productos[$i]->producto         = $request->productos[$i]['nombre'];
        $productos[$i]->cantidad         = $request->productos[$i]['cantidad'];
        $productos[$i]->valor_unitario   = $request->productos[$i]['valor'];
        $total = $total + $productos[$i]->cantidad * $productos[$i]->valor_unitario;
      }
      $gasto->valor_total = $total;
      $gasto->save();
      $gasto->productos()->saveMany($productos);
      DB::commit();
      return response()->json([
        'gasto'   => new GastoResource($gasto),
        'mensaje' => 'Gasto registrado con éxito.'
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      DB::rollback();
      return response()->json([
        'mensaje' => 'Error al crear el registro de gasto.',
        'gasto'   => new GastoResource($gasto)
      ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }

  private static function lista_productos($producto)
  { }

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
