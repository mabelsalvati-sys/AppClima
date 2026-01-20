<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClimaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ClimaController::class,'index'])->name('clima.index');
Route::get('/create', [ClimaController::class,'create'])->name('clima.create');
Route::post('/store', [ClimaController::class,'store'])->name('clima.store');
Route::get('/show/{id}', [ClimaController::class,'show'])->name('clima.show');
Route::get('/edit/{id}', [ClimaController::class,'edit'])->name('clima.edit');
Route::put('/update/{id}', [ClimaController::class,'update'])->name('clima.update');
Route::delete('/delete/{id}', [ClimaController::class,'destroy'])->name('clima.destroy');