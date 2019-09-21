<?php

namespace App\Http\Controllers\API;

use App\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveClienteRequest;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
  public function index()
  {
    $clientes = Cliente::all();
    return response()->json($clientes);
  }

  public function show(Cliente $cliente)
  {
    return response()->json($cliente);
  }

  public function store(SaveClienteRequest $request)
  {
    $cliente                          = new Cliente;
    $cliente->nombre                  = $request->nombre;
    $cliente->apellidos               = $request->apellidos;
    $cliente->direccion               = $request->direccion;
    $cliente->barrio                  = $request->barrio;
    $cliente->telefono                = $request->telefono;
    $cliente->nacimiento              = $request->nacimiento;
    $cliente->save();
    return response()->json(['mensaje' => 'Cliente creado con éxito.'], Response::HTTP_OK);
  }

  public function update(SaveClienteRequest $request, Cliente $cliente)
  {
    $cliente->nombre                  = $request->nombre;
    $cliente->apellidos               = $request->apellidos;
    $cliente->direccion               = $request->direccion;
    $cliente->barrio                  = $request->barrio;
    $cliente->telefono                = $request->telefono;
    $cliente->nacimiento              = $request->nacimiento;
    $cliente->save();
    return response()->json(['mensaje' => 'Cliente editado con éxito.'], Response::HTTP_OK);
  }

  public function destroy(Cliente $cliente)
  {
    if ($cliente->compras()->count() > 0){
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
