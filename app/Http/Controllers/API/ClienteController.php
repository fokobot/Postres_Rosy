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
      $cliente->delete();
      return response()->json(['mensaje' => 'Cliente eliminado con éxito.'], Response::HTTP_OK);
    }
}
