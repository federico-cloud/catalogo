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

#############################################
############### CRUD MARCAS #################
#############################################

//Route::get('/peticion', [ controlador, 'metodo' ]);

use App\Http\Controllers\MarcaController;

Route::get('/adminMarcas', [MarcaController::class, 'index']);

Route::get('/agregarMarca', [MarcaController::class, 'create']);

Route::post('/agregarMarca', [MarcaController::class, 'store']);

Route::get('/modificarMarca/{idMarca}', [MarcaController::class, 'edit']);

Route::put('/modificarMarca', [MarcaController::class, 'update']);

Route::get('/eliminarMarca/{idMarca}', [MarcaController::class, 'confirmarBaja']);

Route::delete('/eliminarMarca', [MarcaController::class, 'destroy']);

#############################################
############# CRUD CATEGORIAS ###############
#############################################

use App\Http\Controllers\CategoriaController;

Route::get('/adminCategorias',[CategoriaController::class, 'index']);

Route::get('/agregarCategoria', [CategoriaController::class, 'create']);

Route::post('/agregarCategoria', [CategoriaController::class, 'store']);

Route::get('/modificarCategoria/{idCategoria}', [CategoriaController::class, 'edit']);

Route::put('/modificarCategoria', [CategoriaController::class, 'update']);

Route::get('/eliminarCategoria/{idCategoria}', [CategoriaController::class, 'confirmarBaja']);

Route::delete('/eliminarCategoria', [CategoriaController::class, 'destroy']);

#############################################
############# CRUD PRODUCTOS ################
#############################################

use App\Http\Controllers\ProductoController;

Route::get('/portada', [ProductoController::class, 'getAll']);

Route::get('/adminProductos', [ProductoController::class, 'index']);

Route::get('/agregarProducto', [ProductoController::class, 'create']);

Route::post('/agregarProducto', [ProductoController::class, 'store']);

Route::get('/modificarProducto/{idProducto}', [ProductoController::class, 'edit']);

Route::put('/modificarProducto', [ProductoController::class, 'update']);

Route::get('/eliminarProducto/{idProducto}', [ProductoController::class, 'confirmarBaja']);

Route::delete('/eliminarProducto', [ProductoController::class, 'destroy']);
