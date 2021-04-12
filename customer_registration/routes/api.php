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
Route::get('listar/{client}', 'App\Http\Controllers\ClientController@show')->name('client.show');
Route::put('alterar/{client}', 'App\Http\Controllers\ClientController@update')->name('client.update');
Route::patch('alterar/{client}', 'App\Http\Controllers\ClientController@update')->name('client.update');
Route::delete('deletar/{client}', 'App\Http\Controllers\ClientController@destroy')->name('client.destroy');
