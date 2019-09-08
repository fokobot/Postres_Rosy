<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

  public function destroy(Gasto $gasto)
  {
    $gasto->delete();
    return response()->json(['mensaje' => 'Gasto eliminado con éxito.'], Response::HTTP_OK);
  }
}
