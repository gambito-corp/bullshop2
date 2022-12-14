<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PruebaController;

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

Route::get('login', [AuthController::class, 'Login']);

Route::get('home', [HomeController::class, 'index']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('prueba',[PruebaController::class, 'ActualizarCategoriasWooComerce']);
Route::get('prueba2',[PruebaController::class, 'ActualizarProductosWooComerce']);
