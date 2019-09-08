<?php

namespace App\Http\Controllers\API;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
    public function index()
    {
      $clientes = Cliente::all();
      $tipos_de_documento = \App\TipoDeDocumento::all();
      return response()->json([
        'clientes'          => $clientes,
        'tipos_de_documento' => $tipos_de_documento
      ]);
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
