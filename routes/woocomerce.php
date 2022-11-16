<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WooComerceController;
/*
|--------------------------------------------------------------------------
| WooComerce Routes
|--------------------------------------------------------------------------
|
| Here is where you can register WooComerce routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', [WooComerceController::class, 'index']);
//CUPONES
Route::get('cupones', [WooComerceController::class, 'getCoupons']);
//CLIENTES
Route::get('clientes', [WooComerceController::class, 'getCustomers']);
//ORDENES
Route::get('ordenes', [WooComerceController::class, 'getOrders']);
//ORDENES INDIVIDUALIZADAS
Route::get('ordenes/{id}/list', [WooComerceController::class, 'getOrdersNotes']);
//ORDENES DEVUELTAS
Route::get('ordenes/{id}/refund', [WooComerceController::class, 'getOrderRefunds']);
//PRODUCTOS
Route::get('productos', [WooComerceController::class, 'getProducts']);
//CATEGORIAS
Route::get('categorias', [WooComerceController::class, 'getCategory']);

