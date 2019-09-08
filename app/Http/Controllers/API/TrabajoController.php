<?php

namespace App\Http\Controllers\API;

use App\Trabajo;
use App\Http\Requests\SaveTrabajoRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class TrabajoController extends Controller
{
    public function index()
    {
      $trabajos = Trabajo::all();
      return response()->json($trabajos);
    }

    public function store(SaveTrabajoRequest $request)
    {
      $trabajo                = new Trabajo;
      $trabajo->nombre        = $request->nombre;
      $trabajo->costo         = $request->costo;
      $trabajo->save();
      return response()->json(['mensaje' => 'Trabajo creado con éxito'], Response::HTTP_OK);
    }

    public function destroy(Trabajo $trabajo)
    {
      $trabajo->delete();
      return response()->json(['mensaje' => 'Trabajo eliminado con éxito.'], Response::HTTP_OK);
    }
}
