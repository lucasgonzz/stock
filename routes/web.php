<?php

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
    return redirect()->route('venta');
});

Route::get('venta', 'MainController@venta')->name('venta');
Route::get('ingresar', 'MainController@ingresar')->name('ingresar');
Route::get('lista-precios', 'MainController@lista_de_precios')->name('lista-precios');
Route::get('resumen-ventas', 'MainController@resumen_ventas')->name('resumen-ventas');
Route::get('codigo-de-barras', 'MainController@codigos_de_barras')->name('codigo-de-barras');
