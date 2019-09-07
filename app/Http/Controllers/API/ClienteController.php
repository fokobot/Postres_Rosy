<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    public function index()
    {
      $clientes = \App\Cliente::all();
      $tipos_de_documento = \App\TipoDeDocumento::all();
      return response()->json([
        'clientes'          => $clientes,
        'tipos_de_documento' => $tipos_de_documento
      ]);
    }
}
