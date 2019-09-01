<?php

namespace App\Http\Controllers;

use App\Gasto;
use App\Http\Requests\SaveGastoRequest;
use Illuminate\Http\Request;

class GastoController extends Controller
{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			$gastos = Gasto::with('estado')->get();
			return view('gasto.index', compact('gastos'));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			$estados = \App\Estado::all();
			return view('gasto.crear', compact('estados'));
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(SaveGastoRequest $request)
		{
			$gasto                     = new Gasto;
			$gasto->descripcion        = $request->descripcion;
			$gasto->valor              = $request->valor;
			$gasto->estado             = $request->estado;
			$gasto->fecha              = $request->fecha;
			$gasto->save();
			session()->flash('success','Gasto creado con éxito');
			return redirect()->route('gastos.index');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  \App\Gasto  $gasto
		 * @return \Illuminate\Http\Response
		 */
		public function show(Gasto $gasto)
		{
				//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\Gasto  $gasto
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Gasto $gasto)
		{
				//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \App\Gasto  $gasto
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, Gasto $gasto)
		{
				//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Gasto  $gasto
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Gasto $gasto)
		{
				//
		}
}
