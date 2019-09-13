<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveGastoRequest;
use App\Gasto;
use Illuminate\Http\Response;

class GastoController extends Controller
{
  public function index()
  {
    $gastos = Gasto::all();
    $estados = \App\Estado::all();
    return response()->json([
      'gastos'       => $gastos,
      'estados'      => $estados
    ]);
  }

  public function show(Gasto $gasto)
  {
    return response()->json($gasto);
  }

  public function store(SaveGastoRequest $request)
  {
    $gasto                        = new Gasto;
    $gasto->descripcion           = $request->descripcion;
    $gasto->valor                 = $request->valor;
    $gasto->estado_id             = $request->estado_id;
    $gasto->fecha                 = $request->fecha;
    $gasto->save();
    return response()->json(['mensaje' => 'Gasto creado con éxito.'], Response::HTTP_OK);
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
