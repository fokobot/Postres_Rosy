<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveProveedorRequest;
use App\Proveedor;
use Illuminate\Http\Response;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json($proveedores);
    }

    public function show(Proveedor $proveedor)
    {
        return response()->json($proveedor);
    }

    public function store(SaveProveedorRequest $request)
    {
        $proveedor = new Proveedor;
        $proveedor->razon_social    = $request->razon_social;
        $proveedor->telefono        = $request->telefono;
        $proveedor->direccion       = $request->direccion;
        $proveedor->ciudad_id       = $request->ciudad_id;
        $proveedor->gerente         = $request->gerente;
        $proveedor->email           = $request->email;
        $proveedor->edad_rc         = $request->edad_rc;
        $proveedor->save();

        return response()->json(['mensaje' => 'Proveedor creado con éxito.'], Response::HTTP_OK);
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return response()->json(['mensaje' => 'Proveedor eliminado con éxito.'], Response::HTTP_OK);
    }
}
