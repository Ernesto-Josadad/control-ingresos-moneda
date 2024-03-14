<?php
use App\Http\Controllers\GenerarController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ReporteMensualController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\SubgruposController;



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

Route::view('reporte', 'reporte_mensual');
Route::view('login','login');
Route::view('recibo','recibo');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Conchi Routes:
Route::resource('/students', StudentController::class);
Route::resource('/payment', ReciboController::class);
Route::resource('/generar', GenerarController::class);

Route::view('/makePayment', 'formPagos');
// show pdf
Route::get('/payments/{payment}/pdf', [ReciboController::class, 'showPDF'])->name('payments.pdf');

Route::group(['middleware' => 'web'], function () {

    Route::resource('grupos_subgrupos', GruposController::class);


    Route::resource('subgrupos', SubgruposController::class);
});
