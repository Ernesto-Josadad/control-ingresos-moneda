<?php
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TablaController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\GenerarController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubgruposController;
use App\Http\Controllers\ReporteMensualController;



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

//Protegidas

Route::get('/', function () {
    return view('login');
});


Route::get('modeloPrincipal', function () {
    return view('modeloPrincipal');
});


Route::view('panel_control', 'panel_control')->middleware('auth')->name('panel_control');

// ! Rutas del Reporte Mensual

Route::controller(ReporteMensualController::class)->group(function(){
    Route::get('reporte', 'index')->middleware('auth')->name('reporte');
    Route::get('reporte/mes', 'create')->middleware('auth')->name('pdfAuto');
    // //  RUTA EN DESUSO  Route::get('reporte/search', 'search')->name('search');
    Route::post('reporte/pdf', 'generarPDF')->middleware('auth')->name('pdf');
});

Route::view('alumnos', 'alumnos')->middleware('guest')->name('alumnos');
Route::view('prueba', 'prueba');


Route::view('registrate','registrate')->middleware('guest')->name('registrate');
Route::view('login','login')->middleware('guest')->name('login');

Route::post('registrate', [LoginController::class, 'register'])->name('registrate.register');
Route::post('login', [LoginController::class, 'login'])->name('login.login');
Route::get('logout', [LoginController::class, 'destroy'])->name('logout.destroy');


Route::view('tabla_grupos_subgrupos', 'tabla_grupos_subgrupos')->middleware('auth')->name('tabla_grupos_subgrupos');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
// Conchi Routes:

Route::resource('/students', StudentController::class);
Route::resource('/payment', ReciboController::class);
Route::resource('/generar', GenerarController::class);

Route::post('/savePayment', [GenerarController::class, 'savePayment']);
Route::view('/makePayment', 'formPagos');
// show pdf Hola <3
// Route::get('/payments/{payment}/pdf', [ReciboController::class, 'showPDF'])->name('payments.pdf');

Route::resource('/students', StudentController::class)->middleware('auth');
Route::resource('/payment', ReciboController::class)->middleware('auth');
Route::resource('/generar', GenerarController::class)->middleware('auth');
Route::view('/makePayment', 'formPagos')->middleware('auth');
// show pdf
// Route::get('/payments/{payment}/pdf', [ReciboController::class, 'showPDF'])->middleware('auth')->name('payments.pdf');


Route::resource('/grupos_subgrupos', SubgruposController::class)->middleware('auth');
Route::resource('/nuevogrupo', GruposController::class)->middleware('auth');

Route::resource('/tabla_grupos_subgrupos', TablaController::class)->middleware('auth');



Route::resource('prueba',ReciboController::class);
Route::get('/payments/{payment}/pdf', [GenerarController::class, 'verPDF'])->name('payments.pdf');
