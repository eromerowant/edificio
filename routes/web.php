<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    
    Route::get('/departamentos/index', 'DepartamentoController@index')->name('departamentos.index');
    Route::get('/departamentos/create', 'DepartamentoController@create')->name('departamentos.create');
    Route::post('/departamentos/store', 'DepartamentoController@store')->name('departamentos.store');
    Route::get('/departamentos/show', 'DepartamentoController@show')->name('departamentos.show');
    Route::delete('/departamentos/delete', 'DepartamentoController@delete')->name('departamentos.delete');
    
    Route::post('/movimientos/store', 'MovimientoController@store')->name('movimientos.store');
    Route::delete('/movimientos/delete', 'MovimientoController@delete')->name('movimientos.delete');
    Route::get('/movimientos/show', 'MovimientoController@show')->name('movimientos.show');
    Route::post('/movimientos/cambiar_status', 'MovimientoController@cambiar_status')->name('movimientos.cambiar_status');
    Route::get('/movimientos/escoger_excel', 'MovimientoController@escoger_excel')->name('movimientos.escoger_excel');
    Route::post('/movimientos/subir_excel_con_gastos_comunes', 'MovimientoController@subir_excel_con_gastos_comunes')->name('movimientos.subir_excel_con_gastos_comunes');

    Route::get('/ajax/get_departamentos', 'AjaxController@get_departamentos')->name('get_departamentos');
    Route::get('/ajax/get_movimientos', 'AjaxController@get_movimientos')->name('get_movimientos');
});