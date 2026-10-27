<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaWebController;



// Rutas de Administración
Route::get('/citas', [CitaWebController::class, 'index'])->name('citas.index');
Route::get('/citas/crear', [CitaWebController::class, 'create'])->name('citas.create');
Route::post('/citas', [CitaWebController::class, 'store'])->name('citas.store');