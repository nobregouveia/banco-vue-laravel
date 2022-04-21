<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/contas/extrato/{numero_conta}/{codigo_conta}/{agencia}', 'ContaController@extrato');
Route::get('/contas/saldo/{numero_conta}/{codigo_conta}/{agencia}', 'ContaController@saldo');
Route::post('/contas', 'ContaController@create');
Route::post('/contas/transacao', 'ContaController@transacao');
