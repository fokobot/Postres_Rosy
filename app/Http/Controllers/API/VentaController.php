<?php

namespace App\Http\Controllers\API;

use App\Venta;
use Illuminate\Http\Request;
use App\Http\Requests\SaveVentaRequest;
use App\Http\Controllers\Controller;

class VentaController extends Controller
{
    public function store(SaveVentaRequest $request)
    {
        return response()->json($request->all());
    }
}
