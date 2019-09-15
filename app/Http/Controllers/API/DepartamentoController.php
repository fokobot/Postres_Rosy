<?php

namespace App\Http\Controllers\API;

use App\Departamento;
use App\Http\Controllers\Controller;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        return response()->json($departamentos);
    }

    public function show(Departamento $departamento)
    {
        $ciudades = $departamento->ciudades()->get();
        return response()->json($ciudades);
    }

}
