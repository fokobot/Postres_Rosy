<?php

namespace App\Http\Controllers\API;

use App\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveClienteRequest;
use App\Http\Resources\ClienteResource;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
  public function index()
  {
    $clientes = Cliente::all();
    return ClienteResource::collection($clientes);
  }

  public function show(Cliente $cliente)
  {
    return new ClienteResource($cliente);
  }

  public function store(SaveClienteRequest $request)
  {
    $cliente                          = new Cliente;
    $cliente->tipo_de_documento_id    = $request->tipo_de_documento;
    $cliente->documento               = $request->documento;
    $cliente->nombre                  = $request->nombre;
    $cliente->apellidos               = $request->apellidos;
    $cliente->direccion               = $request->direccion;
    $cliente->barrio                  = $request->barrio;
    $cliente->telefono                = $request->telefono;
    $cliente->fecha_de_nacimiento     = $request->fecha_de_nacimiento;
    $cliente->email                   = $request->email;
    $cliente->save();
    return response()->json([
      'cliente' => new ClienteResource($cliente),
      'mensaje' => 'Cliente creado con éxito.'
    ], Response::HTTP_OK);
  }

  public function update(SaveClienteRequest $request, Cliente $cliente)
  {
    $cliente->tipo_de_documento_id    = $request->tipo_de_documento;
    $cliente->documento               = $request->documento;
    $cliente->nombre                  = $request->nombre;
    $cliente->apellidos               = $request->apellidos;
    $cliente->direccion               = $request->direccion;
    $cliente->barrio                  = $request->barrio;
    $cliente->telefono                = $request->telefono;
    $cliente->fecha_de_nacimiento     = $request->fecha_de_nacimiento;
    $cliente->email                   = $request->email;
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
