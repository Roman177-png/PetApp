<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [\App\Http\Controllers\PetController::class, 'index'])->name('pets.index');

Route::get('/pets/create', [\App\Http\Controllers\PetController::class, 'create'])->name('pets.create');

Route::post('/pets', [\App\Http\Controllers\PetController::class, 'store'])->name('pets.store');

Route::get('/pets/{id}', [\App\Http\Controllers\PetController::class, 'show'])->name('pets.show');

Route::get('/pets/{id}/edit', [\App\Http\Controllers\PetController::class, 'edit'])->name('pets.edit');

Route::put('/pets/{id}', [\App\Http\Controllers\PetController::class, 'update'])->name('pets.update');

Route::delete('/pets/{id}', [\App\Http\Controllers\PetController::class, 'destroy'])->name('pets.destroy');
