<?php

namespace App\Http\Controllers;

use App\Venta;
use App\Http\Requests\SaveVentaRequest;
use Illuminate\Http\Request;
use Auth;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ventas = \App\Venta::all();
      return view('venta.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente_ids = \App\Cliente::all();
        return view('venta.create', compact('cliente_ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveVentaRequest $request)
    {
      $venta                       = new Venta;
      $venta->cliente_id           = $request->cliente_id;
      $venta->vendedor_id          = Auth::user()->id; // OJO CON ESTA LINEA
      $venta->valor_total          = $request->valor_total;
      $venta->estado_venta_id      = 1; // OJO A ESTO
      $venta->costo_domicilio      = $request->costo_domicilio;
      $venta->direccion_domicilio  = $request->direccion_domicilio;
      $venta->fecha                = $request->fecha;
      $venta->save();
      session()->flash('success','Venta creada con éxito');
      return redirect()->route('ventas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
