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

Route::get('/', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@loginPost');

Route::post('logout', 'AuthController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('usuarios', 'UserController');
    Route::resource('insumos', 'SupplyController');
    Route::resource('productos', 'ProductController');
    Route::resource('recetas', 'RecipeController');
    Route::resource('ordenes-de-fabricacion', 'DepartureController');
    Route::resource('ordenes-de-compra', 'EntranceController');
    Route::resource('clientes', 'ClientController');
    Route::resource('moldes', 'MoldController');
    Route::resource('bitacora', 'LogBookController');

    Route::get('ordenes-de-fabricacion/{id}/escanear', 'DepartureController@scan');
    
});


