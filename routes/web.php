<?php

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
Route::get('registrar', [RegisterController::class, 'showRegistrationForm'] )->name('registrar');
Route::post('registrar', [RegisterController::class, 'register'] )->name('registrar');
Route::get('inicio', [UsuarioController::class, 'inicio'] )->name('inicio')->middleware("VerificarEmail");
Route::get('verificacion', [UsuarioController::class, 'verificacion'] )->name('verificacion');
Route::post('verificacion', [UsuarioController::class, 'verificacionEmail'] )->name('verificacion');

Route::get('sesiones', [UsuarioController::class, 'sesiones'])->name('sesiones');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
