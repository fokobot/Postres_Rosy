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
      if ($producto->ventas()->count() > 0){
        $mensaje = 'No es posible eliminar el producto, tiene compras asociadas.';
        $status = Response::HTTP_UNPROCESSABLE_ENTITY;
      } else {
        $producto->delete();
        $mensaje = 'Producto eliminado con éxito.';
        $status = Response::HTTP_OK;
      }
      return response()->json(['mensaje' => $mensaje], $status);
    }
}
