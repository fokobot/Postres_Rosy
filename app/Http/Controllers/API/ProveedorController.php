<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveProveedorRequest;
use App\Http\Resources\ProveedorResource;
use App\Proveedor;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json(ProveedorResource::collection($proveedores));
    }

    public function show(Proveedor $proveedor)
    {
        return response()->json(new ProveedorResource($proveedor));
    }

    public function store(SaveProveedorRequest $request)
    {
        DB::beginTransaction();
        try {
        $proveedor = new Proveedor;
        $proveedor->razon_social    = $request->razon_social;
        $proveedor->telefono        = $request->telefono;
        $proveedor->direccion       = $request->direccion;
        $proveedor->ciudad_id       = $request->ciudad;
        $proveedor->gerente         = $request->gerente;
        $proveedor->email           = $request->email;
        $proveedor->edad_rc         = $request->edad_rc;
        $proveedor->save();

        return response()->json([
            'proveedor' => new ProveedorResource($proveedor),
            'mensaje'   => 'Proveedor creado con éxito.'
        ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(SaveProveedorRequest $request, Proveedor $proveedor)
    {
        $proveedor->razon_social    = $request->razon_social;
        $proveedor->telefono        = $request->telefono;
        $proveedor->direccion       = $request->direccion;
        $proveedor->ciudad_id       = $request->ciudad;
        $proveedor->gerente         = $request->gerente;
        $proveedor->email           = $request->email;
        $proveedor->edad_rc         = $request->edad_rc;
        $proveedor->save();

        return response()->json([
            'proveedor' => $proveedor,
            'mensaje'   => 'Proveedor editado con éxito.'
        ], Response::HTTP_OK);
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return response()->json(['mensaje' => 'Proveedor eliminado con éxito.'], Response::HTTP_OK);
    }
}
