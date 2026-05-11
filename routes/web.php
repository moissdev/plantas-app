<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantaController;

Route::get('/', fn() => redirect()->route('plantas.index'));

Route::get   ('/plantas',          [PlantaController::class, 'index'])   ->name('plantas.index');
Route::post  ('/plantas',          [PlantaController::class, 'store'])   ->name('plantas.store');
Route::delete('/plantas/{planta}', [PlantaController::class, 'destroy'])->name('plantas.destroy');
