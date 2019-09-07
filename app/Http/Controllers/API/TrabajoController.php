<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrabajoController extends Controller
{
    public function index()
    {
      $trabajos = \App\Trabajo::all();
      return response()->json($trabajos);
    }
}
