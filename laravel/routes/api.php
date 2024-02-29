<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta para devolver los emails de los profesores
Route::get('emails', [ApiController::class, 'get_emails'])->name('emails');

// Ruta para devolver la estructura de datos necesarios para el frontend
Route::get('lmdata', [ApiController::class, 'data_structure'])->name('lmdata');