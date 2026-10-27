<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CitaApiController;

Route::get('/citas', [CitaApiController::class, 'index']);
Route::middleware('auth:sanctum')->post('/citas', [CitaApiController::class, 'store']);