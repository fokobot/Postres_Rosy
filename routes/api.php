<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tipos_de_documento', 'API\TipoDeDocumentoController@index');
Route::get('productos', 'API\ProductoController@index');
Route::delete('productos/{producto}', 'API\ProductoController@destroy');
Route::get('trabajos', 'API\TrabajoController@index');
Route::delete('trabajos/{trabajo}', 'API\TrabajoController@destroy');
Route::get('clientes', 'API\ClienteController@index');
Route::get('gastos', 'API\GastoController@index');
Route::delete('gastos/{gasto}', 'API\GastoController@destroy');
Route::get('ventas', 'API\VentaController@index');
Route::delete('ventas/{venta}', 'API\VentaController@destroy');
Route::post('ventas', 'API\VentaController@store');
