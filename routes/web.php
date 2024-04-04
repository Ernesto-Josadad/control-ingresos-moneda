<?php
use App\Http\Controllers\GenerarController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ReporteMensualController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\SubgruposController;
use App\Http\Controllers\TablaController;
use Illuminate\Routing\RouteGroup;


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

//Auth

Route::prefix('auth')->group(function(){
    Route::get('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerVerify'])->name('login.verify');
    Route::post('login', [AuthController::class, 'loginVerify']);
});

//Protegidas

Route::middleware(['auth'])->group(function () {
    Route::get('panel_control', function(){
        return view('panel_control')->name('panel_control');
    });
});

Route::get('/', function () {
    return view('login');
});


Route::get('modeloPrincipal', function () {
    return view('modeloPrincipal');
});


Route::view('panel_control', 'panel_control');

// ! Rutas del Reporte Mensual

Route::controller(ReporteMensualController::class)->group(function(){
    Route::get('reporte', 'index')->name('reporte');
    Route::get('reporte/mes', 'create')->name('pdfAuto');
    // //  RUTA EN DESUSO  Route::get('reporte/search', 'search')->name('search');
    Route::post('reporte/pdf', 'generarPDF')->name('pdf');
});

Route::view('alumnos', 'alumnos');
Route::view('prueba', 'prueba');

Route::view('login','login');
Route::view('tabla_grupos_subgrupos', 'tabla_grupos_subgrupos');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Conchi Routes:
Route::resource('/students', StudentController::class);
Route::resource('/payment', ReciboController::class);
Route::resource('/generar', GenerarController::class);

Route::post('/savePayment', [GenerarController::class, 'savePayment']);
Route::view('/makePayment', 'formPagos');
// show pdf Hola <3
Route::get('/payments/{payment}/pdf', [ReciboController::class, 'showPDF'])->name('payments.pdf');

Route::resource('/grupos_subgrupos', SubgruposController::class);
Route::resource('/nuevogrupo', GruposController::class);

Route::resource('/tabla_grupos_subgrupos', TablaController::class);

Route::group(['middleware' => 'web'], function () {
    Route::resource('grupos_subgrupos', GruposController::class);
    Route::resource('subgrupos', SubgruposController::class);
});
Route::resource('/grupos_subgrupos', SubgruposController::class);
Route::resource('/nuevogrupo', GruposController::class);

Route::resource('prueba',ReciboController::class);
Route::get('/payments/{payment}/pdf', [GenerarController::class, 'verPDF'])->name('payments.pdf');