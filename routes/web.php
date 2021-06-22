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


#############################################
############### CRUD MARCAS #################
#############################################

//Route::get('/peticion', [ controlador, 'metodo' ]);

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;

Route::get  ('/adminMarcas',    
                [ 
                    MarcaController::class, 'index' 
                ]
            );

Route::get  ('/agregarMarca',
                [
                    MarcaController::class, 'create'
                ]
            );

Route::post  ('/agregarMarca',
                [
                    MarcaController::class, 'store'
                ]
            );

#############################################
############# CRUD CATEGORIAS ###############
#############################################


Route::get  ('/adminCategorias',
                [
                    CategoriaController::class, 'index'
                ]
            );

Route::get  ('/agregarCategoria',
                [
                    CategoriaController::class, 'create'
                ]
            );

Route::post ('/agregarCategoria',
                [
                    CategoriaController::class, 'store'
                ]   
            );