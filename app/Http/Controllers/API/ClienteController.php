<?php

namespace App\Http\Controllers\API;

use App\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveClienteRequest;
use App\Http\Resources\ClienteResource;
use App\Persona;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
  public function index()
  {
    $clientes = Cliente::all();
    return response()->json(ClienteResource::collection($clientes));
  }

  public function show(Cliente $cliente)
  {
    return response()->json(new ClienteResource($cliente));
  }

  public function store(SaveClienteRequest $request)
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
      // -- cliente -- //
      $cliente                  = new Cliente;
      $cliente->email           = $request->email;
      $cliente->estrato_social  = $request->estrato_social;
      $cliente->persona()->associate($persona);
      $cliente->save();
      DB::commit();
      return response()->json([
        'cliente' => new ClienteResource($cliente),
        'mensaje' => 'Cliente creado con éxito.'
      ], Response::HTTP_OK);
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function update(SaveClienteRequest $request, Cliente $cliente)
  {
    $persona                       = $cliente->persona;
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

    $cliente->email           = $request->email;
    $cliente->estrato_social  = $request->estrato_social;
    $cliente->persona()->associate($persona);
    $cliente->save();
    return response()->json([
      'cliente' => new ClienteResource($cliente),
      'mensaje' => 'Cliente editado con éxito.'
    ], Response::HTTP_OK);
  }

  public function destroy(Cliente $cliente)
  {
    if ($cliente->compras()->count() > 0) {
      $mensaje = 'No es posible eliminar el cliente, tiene compras asociadas.';
      $status = Response::HTTP_UNPROCESSABLE_ENTITY;
    } else {
      $cliente->delete();
      $mensaje = 'Cliente eliminado con éxito.';
      $status = Response::HTTP_OK;
    }
    return response()->json(['mensaje' => $mensaje], $status);
  }
}
