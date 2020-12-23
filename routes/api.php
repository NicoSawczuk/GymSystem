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

//Consultas para el pago
Route::get('/pagos/monto', 'MontoMensualController@getMonto')->name('pagos.getMonto');

Route::get('/codigos/check', 'DescuentoController@checkCodigo')->name('codigos.check');

//MercadoPago
Route::post('/pagos/finalizar_pago', 'PagoUsuarioController@finalizarPago')->name('pagos.finalizarPago');