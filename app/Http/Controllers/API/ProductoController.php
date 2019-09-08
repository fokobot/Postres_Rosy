<?php

namespace App\Http\Controllers\API;

use App\Producto;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductoController extends Controller
{

    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    public function destroy(Producto $producto)
    {
      $producto->delete();
      return response()->json(['mensaje' => 'Producto eliminado con éxito.'], Response::HTTP_OK);
    }
}
