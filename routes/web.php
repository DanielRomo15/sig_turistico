<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuntoInteresController;

// Página principal (redirige al listado con mapa)
Route::get('/', [PuntoInteresController::class, 'index'])->name('home');

// Ruta principal con buscador
Route::get('/puntos', [PuntoInteresController::class, 'index'])->name('puntos.index');

// Todas las demás rutas RESTful
Route::resource('puntos', PuntoInteresController::class)->except(['index']);
