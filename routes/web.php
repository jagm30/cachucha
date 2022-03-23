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