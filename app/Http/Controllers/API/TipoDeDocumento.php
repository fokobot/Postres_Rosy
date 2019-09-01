<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipoDeDocumento extends Controller
{
    public function index()
    {
        $tiposdedocumento = App\TipoDeDocumento::all();
        return response()->json($tiposdedocumento);
    }
}
