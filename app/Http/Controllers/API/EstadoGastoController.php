<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstadoGastoController extends Controller
{
  public function index()
  {
    $estados = \App\Estado::all();
    return response()->json($estados);
  }
}
