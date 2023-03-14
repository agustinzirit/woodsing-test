<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsuarioController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', function () {
    return redirect()->route("inicio");
});
Route::get('/home', function () {
    return redirect()->route("inicio");
});

Route::get('registrar', [RegisterController::class, 'showRegistrationForm'] )->name('registrar');
Route::post('registrar', [RegisterController::class, 'register'] )->name('registrar');
Route::get('inicio', [UsuarioController::class, 'inicio'] )->name('inicio')->middleware("VerificarEmail");
Route::get('verificacion', [UsuarioController::class, 'verificacion'] )->name('verificacion');
Route::post('verificacion', [UsuarioController::class, 'verificacionEmail'] )->name('verificacion');
Route::get("two-factor/{datos}", [UsuarioController::class, 'dobleFactor'])->name('two-factor-verify');
Route::post("two-factor", [UsuarioController::class, 'verificarDobleFactor'])->name('two-factor');
Route::get('sesiones', [LoginController::class, 'showLoginForm'])->name('sesiones');
Route::post('sesiones', [LoginController::class, 'login'])->name('sesiones');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
