<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormacionController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Support\Facades\Route;

// Rutas de recursos para gestionar las tablas
Route::resource('profesor', ProfesorController::class);
Route::resource('formacion', FormacionController::class);
Route::resource('modulo', ModuloController::class);
Route::resource('grupo', GrupoController::class);
Route::resource('leccion', LeccionController::class);
Route::resource('admin', AdminController::class);

// 
Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home.home');
// Ruta para el perfil del usuario
Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('profile/{user}', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');