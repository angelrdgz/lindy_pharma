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

    Route::get('/exportar/bitacora', 'LogbookController@export');
    Route::get('/exportar/clientes', 'ClientController@export');
    Route::get('/exportar/insumos', 'SupplyController@export');
    Route::get('/exportar/insumos-stock', 'SupplyController@exportStock');
    Route::get('/exportar/insumos/{id}', 'SupplyController@exportSupply');
    Route::get('/exportar/moldes', 'MoldController@export');
    Route::get('/exportar/recetas', 'RecipeController@export');
    Route::get('/exportar/recetas/{id}', 'RecipeController@exportRecipe');

    Route::resource('usuarios', 'UserController');
    Route::resource('insumos', 'SupplyController');
    Route::resource('productos', 'ProductController');
    Route::resource('recetas', 'RecipeController');
    Route::resource('ordenes-de-fabricacion', 'DepartureController');
    Route::resource('ordenes-de-compra', 'EntranceController');
    Route::resource('ordenes-de-acondicionamiento', 'PackingController');
    Route::resource('clientes', 'ClientController');
    Route::resource('moldes', 'MoldController');
    Route::resource('bitacora', 'LogBookController');
    Route::resource('proveedores', 'SupplierController');
    Route::resource('proveedores', 'SupplierController');
    Route::resource('descargas', 'DecreaseController');


    Route::get('ordenes-de-fabricacion/{id}/escanear', 'DepartureController@scan');
    Route::put('ordenes-de-fabricacion/{id}/items', 'DepartureController@updateItems');
    
});


