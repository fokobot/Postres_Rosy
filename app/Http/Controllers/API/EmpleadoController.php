<?php

namespace App\Http\Controllers\API;

use App\Empleado;
use App\Http\Requests\SaveEmpleadoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class EmpleadoController extends Controller
{
    public function index()
  {
    $empleados = Empleado::all();
    $tipos_de_documento = \App\TipoDeDocumento::all();
    return response()->json([
      'empleados'          => $empleados,
      'tipos_de_documento' => $tipos_de_documento
    ]);
  }

  public function show(Empleado $empleado)
  {
    return response()->json($empleado);
  }

  public function store(SaveEmpleadoRequest $request)
  {
    $empleado                          = new Empleado;
    $empleado->tipo_de_documento_id    = $request->tipo_de_documento_id;
    $empleado->documento               = $request->documento;
    $empleado->nombres                 = $request->nombres;
    $empleado->apellidos               = $request->apellidos;
    $empleado->direccion               = $request->direccion;
    $empleado->barrio                  = $request->barrio;
    $empleado->telefono                = $request->telefono;
    $empleado->ocupacion               = $request->ocupacion;
    $empleado->save();
    return response()->json(['mensaje' => 'Empleado creado con éxito.'], Response::HTTP_OK);
  }

  public function update(SaveEmpleadoRequest $request, Empleado $empleado)
  {
    $empleado->tipo_de_documento_id    = $request->tipo_de_documento_id;
    $empleado->documento               = $request->documento;
    $empleado->nombres                 = $request->nombres;
    $empleado->apellidos               = $request->apellidos;
    $empleado->direccion               = $request->direccion;
    $empleado->barrio                  = $request->barrio;
    $empleado->telefono                = $request->telefono;
    $empleado->ocupacion               = $request->ocupacion;
    $empleado->save();
    return response()->json(['mensaje' => 'Empleado editado con éxito.'], Response::HTTP_OK);
  }

  public function destroy(Empleado $empleado)
  {
      $empleado->delete();
      $mensaje = 'Empleado eliminado con éxito.';
      $status = Response::HTTP_OK;
    return response()->json(['mensaje' => $mensaje], $status);
  }
}
