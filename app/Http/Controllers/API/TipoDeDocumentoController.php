<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoDeDocumentoController extends Controller
{
    public function index()
    {
        $tiposdedocumento = \App\TipoDeDocumento::all();
        return response()->json($tiposdedocumento);
    }
}
