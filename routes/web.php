<?php

use App\Http\Controllers\ReciboController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\SubgruposController;
use App\Http\Controllers\TablaController;
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
Route::view('prueba', 'prueba');

Route::view('login','login');
Route::view('tabla_grupos_subgrupos', 'tabla_grupos_subgrupos');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Conchi Routes: 
Route::resource('/students', StudentController::class);
Route::resource('/payment', ReciboController::class);
Route::view('/makePayment', 'formPagos');
// show pdf 
Route::get('/payments/{payment}/pdf', [ReciboController::class, 'showPDF'])->name('payments.pdf');

// =============================================================================================>
Route::resource('/grupos_subgrupos', SubgruposController::class);
Route::resource('/nuevogrupo', GruposController::class);

Route::resource('/tabla_grupos_subgrupos', TablaController::class);

