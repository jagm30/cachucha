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
Route::get('productos/descargarPDF', 'ProductoController@descargarPDF')->name('descargarPDF');
Route::get('productos/descargarExcel', 'ProductoController@descargarExcel')->name('descargarExcel');
Route::post('productos/edicion', 'ProductoController@edicion')->name('edicion');
Route::resource('productos', 'ProductoController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('entradasproductos/finalizar/{id}', 'EntradaproductoController@finalizar')->name('finalizar');
Route::get('entradasproductos/delete/{id}', 'EntradaproductoController@destroy')->name('delete');
Route::resource('entradasproductos', 'EntradaproductoController');
Route::get('entradas/reportepdffecha/{fecha1}/{fecha2}', 'EntradaController@reportepdffecha');
Route::get('entradas/reportepdf/{id}', 'EntradaController@reportepdf');
Route::get('entradas/reporte/', 'EntradaController@reporte');
Route::resource('entradas', 'EntradaController');
Route::get('exportinventario', 'InventarioController@export')->name('exportinventario');
Route::resource('inventarios', 'InventarioController');