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

/*Carrito */
Route::post('/carritoadd',[CamisetaController::class, 'CartAdd']);

Route::get('/carritoview',[CamisetaController::class, 'CartCheckout']);

Route::get('/carritovaciar',[CamisetaController::class, 'CartClearOut']);

//Route::get('/carritoview',[CamisetaController::class, 'CartCheckout']);

/*LogIn y LogOut*/
Route::get('',[CamisetaController::class, 'mostrarCamisetaLog']);

Route::get('login',[CamisetaController::class, 'loginusu']);

Route::post('login',[CamisetaController::class, 'loginPost']);

Route::get('logout',[CamisetaController::class, 'logout']);

/*Mostrar*/
Route::get('/principal',[CamisetaController::class, 'mostrarCamiseta']);

Route::get('/principal_log',[CamisetaController::class, 'mostrarCamisetaLog']);

Route::get('/principal_admin',[CamisetaController::class, 'mostrarCamisetaAdm']);

//Filtro Principal en AJAX
Route::post('principal/show',[CamisetaController::class,'show']);

/*Crear*/
Route::get('/crear',[CamisetaController::class, 'crearCamiseta']);

Route::post('/crear-proc',[CamisetaController::class, 'crearCamisetaPost']);

/*Eliminar*/
Route::delete('/eliminarCamiseta/{id}', [CamisetaController::class, 'eliminarCamiseta']);

/*Dinero*/
Route::get('enviarDinero/{precio_total}/',[CamisetaController::class, 'enviarDinero']);

Route::get('comprado',[CamisetaController::class, 'compra']);