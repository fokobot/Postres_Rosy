<?php

namespace App\Http\Controllers\API;

use App\Empleado;
use App\Http\Requests\SaveEmpleadoRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmpleadoResource;
use App\Persona;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
  public function index()
  {
    $empleados = Empleado::all();
    return response()->json(EmpleadoResource::collection($empleados));
  }

  public function show(Empleado $empleado)
  {
    return response()->json(new EmpleadoResource($empleado));
  }

  public function store(SaveEmpleadoRequest $request)
  {
    DB::beginTransaction();
    try {
      // -- persona -- //
      $persona                       = new Persona;
      $persona->tipo_de_documento_id = $request->persona['tipo_de_documento'];
      $persona->documento            = $request->persona['documento'];
      $persona->nombre               = $request->persona['nombre'];
      $persona->apellidos            = $request->persona['apellidos'];
      $persona->direccion            = $request->persona['direccion'];
      $persona->barrio               = $request->persona['barrio'];
      $persona->telefono             = $request->persona['telefono'];
      $persona->celular              = $request->persona['celular'];
      $persona->ciudad_id            = $request->persona['ciudad'];
      $persona->fecha_de_nacimiento  = $request->persona['fecha_de_nacimiento'];
      $persona->save();
      // -- empleado -- //
      $empleado                  = new Empleado;
      $empleado->conyuge         = $request->conyuge;
      $empleado->estado_civil_id = $request->estado_civil;
      $empleado->persona()->associate($persona);
      $empleado->save();
      // -- usuario -- //
      $usuario           = new User;
      $usuario->nombre   = $persona->nombre . ' ' . $persona->apellidos;   
      $usuario->email    = $request->usuario['email'];
      $usuario->password = \bcrypt($request->usuario['password']);
      $usuario->persona()->associate($persona);
      // asigna rol y guarda
      $usuario->setRole('vendedor'); // TODO SET TO EMPLEADO
      // -- guardar cambios -- //
      DB::commit();
      return response()->json(['mensaje' => 'Empleado creado con éxito.'], Response::HTTP_OK);
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
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
