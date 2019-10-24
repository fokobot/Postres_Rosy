<?php

namespace App\Http\Controllers\API;

use App\Producto;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\SaveProductoRequest;
use Illuminate\Http\Response;

class ProductoController extends Controller
{

    public function index()
    {
      $productos = Producto::all();
      return response()->json(ProductoResource::collection($productos));
    }

    public function show(Producto $producto)
    {
      return response()->json(new ProductoResource($producto));
    }

    public function store(SaveProductoRequest $request)
    {
      $producto                    = new Producto;
      $producto->nombre            = $request->nombre;
      $producto->valordetal        = $request->valordetal;
      $producto->valormayor        = $request->valormayor;
      $producto->minimopormayor    = $request->minimopormayor;
      $producto->save();
      return response()->json([
        'producto'  => $producto,
        'mensaje'   => 'Producto creado con éxito.'
      ], Response::HTTP_OK);
    }

    public function update(SaveProductoRequest $request, Producto $producto)
    {
      $producto->nombre            = $request->nombre;
      $producto->valordetal        = $request->valordetal;
      $producto->valormayor        = $request->valormayor;
      $producto->minimopormayor    = $request->minimopormayor;
      $producto->save();
      return response()->json([
        'producto'  => $producto,
        'mensaje'   => 'Producto editado con éxito.'
      ], Response::HTTP_OK);
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
