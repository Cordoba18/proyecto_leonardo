<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InicioController;

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect()->route('login');
})->name('');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/ingreso', [LoginController::class, 'logueo'])->name('login.ingreso');
Route::get('/cerrar_sesion', [LoginController::class, 'logout'])->name('logout');


Route::get('/registro', [RegisterController::class, 'index'])->name('registro');
Route::post('/registro/guardar', [RegisterController::class, 'register'])->name('registro.guardar');
Route::middleware(['auth',])->group(function () {

Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');


});
