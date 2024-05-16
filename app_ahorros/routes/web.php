<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\TarjetasController;
use App\Http\Controllers\GastosIngresosController;
use App\Http\Controllers\MovimientosUsuarioController;
use App\Http\Controllers\MetasAhorrosController;
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

    Route::group(['prefix' => 'inicio'], function () {
        Route::get('', [InicioController::class, 'index'])->name('inicio');

        Route::group(['prefix' => 'tarjetas'], function () {
            Route::get('', [TarjetasController::class, 'index'])->name('tarjetas');
            Route::get('/crear', [TarjetasController::class, 'create'])->name('tarjetas.crear');
            Route::post('/crear/guardar', [TarjetasController::class, 'save'])->name('tarjetas.guardar');
            Route::post('/eliminar', [TarjetasController::class, 'delete'])->name('tarjetas.eliminar');


        });

        Route::group(['prefix' => 'gastos_ingresos'], function () {
            Route::get('', [GastosIngresosController::class, 'index'])->name('gastos_ingresos');
            Route::post('/guardar', [GastosIngresosController::class, 'save'])->name('gastos_ingresos.guardar');
        });

        Route::group(['prefix' => 'movimientos_usuario'], function () {
            Route::get('', [MovimientosUsuarioController::class, 'index'])->name('movimientos_usuario');

        });

        Route::group(['prefix' => 'metas_ahorro'], function () {
            Route::get('', [MetasAhorrosController::class, 'index'])->name('metas_ahorro');
            Route::get('/crear', [MetasAhorrosController::class, 'create'])->name('metas_ahorro.crear');
            Route::post('/crear/guardar', [MetasAhorrosController::class, 'save'])->name('metas_ahorro.crear.guardar');
            Route::get('/editar/{id}', [MetasAhorrosController::class, 'edit'])->name('metas_ahorro.editar');
            Route::post('/editar/guardar', [MetasAhorrosController::class, 'update'])->name('metas_ahorro.editar.guardar');
            Route::post('/eliminar', [MetasAhorrosController::class, 'delete'])->name('metas_ahorro.eliminar');
            Route::get('/editar/dastos_grafica_mi_ahorro/{id}', [MetasAhorrosController::class, 'dastos_grafica_mi_ahorro'])->name('metas_ahorro.editar.dastos_grafica_mi_ahorro');
            Route::get('/datos_tarjetas_mis_ahorros', [MetasAhorrosController::class, 'datos_tarjetas_mis_ahorros'])->name('metas_ahorro.datos_tarjetas_mis_ahorros');
        });

    });

});
