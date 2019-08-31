<?php

namespace App\Http\Controllers\API;

use App\Producto;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }
    
}
