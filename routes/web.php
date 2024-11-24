<?php

use App\Client\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
Route::get('/clients/edit/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/update/{client}', [ClientController::class, 'update'])->name('clients.update');
