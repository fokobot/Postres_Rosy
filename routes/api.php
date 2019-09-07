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
Route::get('trabajos', 'API\TrabajoController@index');
Route::get('clientes', 'API\ClienteController@index');
Route::get('gastos', 'API\GastoController@index');
Route::get('ventas', 'API\VentaController@index');
Route::post('ventas', 'API\VentaController@store');
