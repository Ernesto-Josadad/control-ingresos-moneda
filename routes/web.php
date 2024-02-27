<?php

use App\Http\Controllers\ReciboController;
use App\Http\Controllers\StudentController;
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
Route::view('grupos_subgrupos', 'grupos_subgrupos');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/students', StudentController::class);
Route::resource('/payment', ReciboController::class);
// show pdf 
Route::get('/payments/{payment}/pdf', [ReciboController::class, 'showPDF'])->name('payments.pdf');

Route::group(['middleware' => 'web'], function () {
    
    Route::resource('grupos_subgrupos', GruposController::class);

    
    Route::resource('subgrupos', SubgruposController::class);
});