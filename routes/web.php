<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CamisetaController;

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

/*LogIn y LogOut*/
Route::get('',[CamisetaController::class, 'login']);

Route::post('login',[CamisetaController::class, 'loginPost']);

Route::get('logout',[CamisetaController::class, 'logout']);

/*Mostrar*/
Route::get('/principal',[CamisetaController::class, 'mostrarCamiseta']);

/*Crear*/
Route::get('/crear',[CamisetaController::class, 'crearCamiseta']);

Route::post('/crear',[CamisetaController::class, 'crearCamisetaPost']);

/*Eliminar*/
Route::delete('/eliminarCamiseta/{id}', [CamisetaController::class, 'eliminarCamiseta']);