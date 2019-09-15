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

Route::group(['prefix' => 'clientes'], function() {
	Route::get('/', 'API\ClienteController@index');
	Route::post('/', 'API\ClienteController@store');
	Route::get('/{cliente}', 'API\ClienteController@show');
	Route::put('/{cliente}/edit', 'API\ClienteController@update');
	Route::delete('/{cliente}', 'API\ClienteController@destroy');
});

Route::group(['prefix' => 'gastos'], function() {
	Route::get('/', 'API\GastoController@index');
	Route::get('/estados', 'API\EstadoGastoController@index');
	Route::post('/', 'API\GastoController@store');
	Route::get('/{gasto}', 'API\GastoController@show');
	Route::put('/{gasto}/edit', 'API\GastoController@update');
	Route::delete('/{gasto}', 'API\GastoController@destroy');
});

Route::group(['prefix' => 'productos'], function() {
	Route::get('/', 'API\ProductoController@index');
	Route::post('/', 'API\ProductoController@store');
	Route::get('/{producto}', 'API\ProductoController@show');
	Route::put('/{producto}/edit', 'API\ProductoController@update');
	Route::delete('/{producto}', 'API\ProductoController@destroy');
});

Route::group(['prefix' => 'proveedores'], function() {
	Route::get('/', 'API\ProveedorController@index');
	Route::post('/', 'API\ProveedorController@store');
	Route::get('/{proveedor}', 'API\ProveedorController@show');
	Route::put('/{proveedor}/edit', 'API\ProveedorController@update');
	Route::delete('/{proveedor}', 'API\ProveedorController@destroy');
});

Route::group(['prefix' => 'trabajos'], function() {
	Route::get('/', 'API\TrabajoController@index');
	Route::post('/', 'API\TrabajoController@store');
	Route::get('/{trabajo}', 'API\TrabajoController@show');
	Route::put('/{trabajo}/edit', 'API\TrabajoController@update');
	Route::delete('/{trabajo}', 'API\TrabajoController@destroy');
});

Route::group(['prefix' => 'ventas'], function (){
	Route::get('/', 'API\VentaController@index');
	Route::post('/', 'API\VentaController@store');
	Route::delete('ventas/{venta}', 'API\VentaController@destroy');
});

/******************************************************/
Route::group(['prefix' => 'departamentos'], function() {
	Route::get('/', 'API\DepartamentoController@index');
	Route::get('/{departamento}', 'API\DepartamentoController@show');
});