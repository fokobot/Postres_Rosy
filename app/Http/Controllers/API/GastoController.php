<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GastoController extends Controller
{
  public function index()
  {
    $gastos = \App\Gasto::all();
    $estados = \App\Estado::all();
    return response()->json([
      'gastos'       => $gastos,
      'estados'      => $estados
    ]);
  }
}
