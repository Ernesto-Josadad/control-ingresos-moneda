<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('modeloPrincipal', function () {
    return view('modeloPrincipal');
});


Route::view('panel_control', 'panel_control');

Route::view('reporte', 'reporte_mensual');

Route::view('alumnos', 'alumnos');

Route::view('login','login');
Route::view('recibo','recibo');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
