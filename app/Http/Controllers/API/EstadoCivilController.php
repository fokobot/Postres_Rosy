<?php

namespace App\Http\Controllers\API;

use App\EstadoCivil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstadoCivilController extends Controller
{
    public function index()
    {
        return response()->json(EstadoCivil::all());
    }
}
