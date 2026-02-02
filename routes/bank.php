<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\ClienteController;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [DefaultController::class, 'home'])->name('home');

//// CUENTAS

Route::get('/cuenta/list', [CuentaController::class, 'list'])->name('cuenta_list');

Route::match(['get', 'post'], '/cuenta/new', [CuentaController::class, 'new'])->middleware(['auth', 'verified'])->name('cuenta_new');

Route::get('/cuenta/delete/{id}', [CuentaController::class, 'delete'])->middleware(['auth', 'verified'])->name('cuenta_delete');

Route::match(['get', 'post'], '/cuenta/update/{id}', [CuentaController::class, 'update'])->middleware(['auth', 'verified'])->name('cuenta_update');

Route::match(['get', 'post'], '/cuenta/filtro', [CuentaController::class, 'filtro'])->name('cuenta_filtro');


//// CLIENTE

Route::get('/cliente/list', [ClienteController::class, 'list'])->name('cliente_list');

Route::match(['get', 'post'], '/cliente/new', [ClienteController::class, 'new'])->middleware(['auth', 'verified'])->name('cliente_new');

Route::get('/cliente/delete/{id}', [ClienteController::class, 'delete'])->middleware(['auth', 'verified'])->name('cliente_delete');

Route::match(['get', 'post'], '/cliente/update/{id}', [ClienteController::class, 'update'])->middleware(['auth', 'verified'])->name('cliente_update');