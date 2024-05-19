<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\UsuariosController;

Route::group(['prefix' => 'autores'], function () {
    Route::get('', [AutoresController::class, 'show'])->name('autores');
Route::post('/create', [AutoresController::class, 'create'])->name('autores.create');
Route::post('/edit', [AutoresController::class, 'edit'])->name('autores.edit');
Route::get('/store/{id}', [AutoresController::class, 'store'])->name('autores.store');
Route::post('/delete', [AutoresController::class, 'delete'])->name('autores.delete');
});
Route::group(['prefix' => 'libros'], function () {
    Route::get('', [LibrosController::class, 'show'])->name('libros');
Route::post('/create', [LibrosController::class, 'create'])->name('libros.create');
Route::post('/edit', [LibrosController::class, 'edit'])->name('libros.edit');
Route::get('/store/{id}', [LibrosController::class, 'store'])->name('libros.store');
Route::post('/delete', [LibrosController::class, 'delete'])->name('libros.delete');
});


Route::group(['prefix' => 'prestamos'], function () {
    Route::get('', [PrestamosController::class, 'show'])->name('prestamos');
Route::post('/create', [PrestamosController::class, 'create'])->name('prestamos.create');
Route::post('/edit', [PrestamosController::class, 'edit'])->name('prestamos.edit');
Route::get('/store/{id}', [PrestamosController::class, 'store'])->name('prestamos.store');
Route::post('/delete', [PrestamosController::class, 'delete'])->name('prestamos.delete');
});


Route::group(['prefix' => 'reservas'], function () {
    Route::get('', [ReservasController::class, 'show'])->name('reservas');
Route::post('/create', [ReservasController::class, 'create'])->name('reservas.create');
Route::post('/edit', [ReservasController::class, 'edit'])->name('reservas.edit');
Route::get('/store/{id}', [ReservasController::class, 'store'])->name('reservas.store');
Route::post('/delete', [ReservasController::class, 'delete'])->name('reservas.delete');
});

Route::group(['prefix' => 'usuarios'], function () {
    Route::get('', [UsuariosController::class, 'show'])->name('usuarios');
Route::post('/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::get('/store/{id}', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::post('/delete', [UsuariosController::class, 'delete'])->name('usuarios.delete');
});


