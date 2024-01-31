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
    return view('welcome');
});
Route::get('modeloPrincipal', function () {
    return view('modeloPrincipal');
});

<<<<<<< HEAD
Route::view('recibo', 'recibo');
=======
Route::get('login2', function () {
    return view('login');
});

Route::view('recibo','recibo');

Route::view('panel_control','panel_control');

Route::view('alumnos','alumnos');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
>>>>>>> 53c4475235b752db6c1b011c2a92cbc29966e27c
