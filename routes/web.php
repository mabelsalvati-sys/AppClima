<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClimaController;

Route::get('/', [ClimaController::class, 'index'])->name('clima.index');
Route::get('/clima/administrar', [ClimaController::class, 'administrar'])->name('clima.administrar');
Route::get('/clima/predicciones', [ClimaController::class, 'predicciones'])->name('clima.predicciones');
Route::get('/clima/editar/{id}', [ClimaController::class, 'edit'])->name('clima.edit');
Route::get('/clima/ver/{id}', [ClimaController::class, 'show'])->name('clima.show');

Route::post('/clima/guardar', [ClimaController::class, 'store'])->name('clima.store');
Route::put('/clima/actualizar/{id}', [ClimaController::class, 'update'])->name('clima.update');
Route::delete('/clima/eliminar/{id}', [ClimaController::class, 'destroy'])->name('clima.destroy');
