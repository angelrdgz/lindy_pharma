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

Route::resource("test", "TestController");

Route::middleware(['auth'])->group(function () {

    Route::get('/exportar/bitacora', 'LogbookController@export');
    Route::get('/exportar/clientes', 'ClientController@export');
    Route::get('/exportar/insumos', 'SupplyController@export');
    Route::get('/exportar/insumos-stock', 'SupplyController@exportStock');
    Route::get('/exportar/insumos/{id}', 'SupplyController@exportSupply');
    Route::get('/exportar/cuarentena', 'SupplyController@exportQuarantine');
    Route::get('/exportar/moldes', 'MoldController@export');
    Route::get('/exportar/recetas', 'RecipeController@export');
    Route::get('/exportar/recetas/{id}', 'RecipeController@exportRecipe');
    Route::get('/exportar/productos', 'ProductController@export');
    Route::get('/exportar/productos/{id}', 'ProductController@exportProduct');
    Route::get('/exportar/ordenes-de-fabricacion', 'DepartureController@export');
    Route::get('/exportar/bitacora-de-descargas', 'EntranceController@exportLogbook');
    Route::get('/exportar/bitacora-de-descargas-materiales', 'EntranceController@exportLogbookMaterial');
    Route::get('inventario-recetas', 'RecipeController@stock');
    Route::get('inventario-recetas/{id}', 'RecipeController@stockDetails');
    Route::put('inventario-recetas/{id}', 'RecipeController@updateStock');
    Route::get('pedidos/{id}/nota', 'OrderController@remitionNote');
    Route::get('inventario-productos', 'ProductController@stock');
    Route::get('inventario-productos/{id}', 'ProductController@stockDetails');
    Route::put('inventario-productos/{id}', 'ProductController@updateStock');
    Route::get('ordenes-de-fabricacion/{id}/revision', 'DepartureController@revision');
    Route::get('ordenes-de-acondicionamiento/{id}/revision', 'PackingController@revision');

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
    Route::resource('descargas-granel', 'DecreasePackageController');
    Route::resource('pedidos', 'OrderController');


    Route::get('ordenes-de-fabricacion/{id}/escanear', 'DepartureController@scan');
    Route::get('ordenes-de-acondicionamiento/{id}/escanear', 'PackingController@scan');
    Route::put('ordenes-de-fabricacion/{id}/items', 'DepartureController@updateItems');
    Route::put('ordenes-de-acondicionamiento/{id}/items', 'PackingController@updateItems');
    Route::put('descargas/{id}/items', 'DecreaseController@updateItems');
    Route::put('descargas-granel/{id}/items', 'DecreasePackageController@updateItems');
    
});


