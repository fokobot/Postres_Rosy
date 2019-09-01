<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\SaveClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposdedocumentos = \App\TipoDeDocumento::all();
        return view('cliente.create', compact('tiposdedocumentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveClienteRequest $request)
    {
      $cliente                             = new Cliente;
      $cliente->tipo_de_documento_id       = $request->tipo_de_documento_id;
      $cliente->documento                  = $request->documento;
      $cliente->nombre                     = $request->nombre;
      $cliente->apellidos                  = $request->apellidos;
      $cliente->direccion                  = $request->direccion;
      $cliente->ciudad                     = $request->ciudad;
      $cliente->telefono                   = $request->telefono;
      $cliente->celular                    = $request->celular;
      $cliente->save();
      session()->flash('success', 'Cliente creado con éxito');
      return redirect()->route('cliente.mostrar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    public function ShowClientelist()
    {
      $clientes = Cliente::all();

      return view('cliente.mostrar', compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
