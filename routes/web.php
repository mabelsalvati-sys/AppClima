<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClimaController;

// --- RUTAS DE CLIMA (GESTIÓN) ---
Route::get('/', [ClimaController::class, 'index'])->name('clima.index');
Route::get('/clima/administrar', [ClimaController::class, 'administrar'])->name('clima.administrar');
Route::get('/clima/editar/{id}', [ClimaController::class, 'edit'])->name('clima.edit');
Route::get('/clima/ver/{id}', [ClimaController::class, 'show'])->name('clima.show');
Route::post('/clima/guardar', [ClimaController::class, 'store'])->name('clima.store');
Route::put('/clima/actualizar/{id}', [ClimaController::class, 'update'])->name('clima.update');
Route::delete('/clima/eliminar/{id}', [ClimaController::class, 'destroy'])->name('clima.destroy');

// --- RUTAS DE PREDICCIONES (SOLUCIÓN AL ERROR) ---
Route::get('/clima/predicciones', [ClimaController::class, 'predicciones'])->name('clima.predicciones');
Route::post('/prediccion/guardar', [ClimaController::class, 'storePrediccion'])->name('prediccion.store');

// Estas 3 rutas son las que el error "Route not found" estaba pidiendo:
Route::get('/prediccion/editar/{id}', [ClimaController::class, 'editPrediccion'])->name('prediccion.edit');
Route::put('/prediccion/actualizar/{id}', [ClimaController::class, 'updatePrediccion'])->name('prediccion.update');
Route::delete('/prediccion/eliminar/{id}', [ClimaController::class, 'destroyPrediccion'])->name('prediccion.destroy');