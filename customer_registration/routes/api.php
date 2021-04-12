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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResource('client','ClientController');

Route::get('listar', 'App\Http\Controllers\ClientController@index')->name('client.index');
Route::post('cadastrar', 'App\Http\Controllers\ClientController@store')->name('client.store');
Route::get('listar/{id_client}', 'App\Http\Controllers\ClientController@view')->name('client.view');
Route::put('alterar/{id_client}', 'App\Http\Controllers\ClientController@update')->name('client.update');
Route::patch('alterar/{id_client}', 'App\Http\Controllers\ClientController@update')->name('client.updatePatch');
Route::delete('deletar/{id_client}', 'App\Http\Controllers\ClientController@delete')->name('client.delete');
