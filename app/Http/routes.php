<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'sgiauth'], function() {

    Route::get('restaurante/lista', 'RestauranteController@lista');
    Route::get('restaurante/ajuda', 'RestauranteController@ajuda');
    Route::get('restaurante/{id}/excluir', 'RestauranteController@excluir');
    Route::get('restaurante/{id}/unidade', 'RestauranteController@unidade');
    Route::resource('restaurante', 'RestauranteController');


    Route::get('caixa/{id}/caixa', 'CaixaController@index');
    Route::get('caixa/{id}/caixaAtual', 'CaixaController@caixaAtual');
    Route::post('caixa/{id}/show', 'CaixaController@show');
    Route::resource('caixa', 'CaixaController');

});
