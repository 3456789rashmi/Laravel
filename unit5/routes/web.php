<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EIController;

Route::get('/', function () {
    return view('welcome');
});

// Student routes
Route::get('/abc', [EIController::class, 'index'])->name('index');
Route::get('/create', [EIController::class, 'create'])->name('create');
Route::post('/store', [EIController::class, 'store'])->name('store');
Route::get('/abc/{id}/edit', [EIController::class, 'edit'])->name('edit');
Route::put('/abc/{id}', [EIController::class, 'update'])->name('update');
Route::delete('/abc/{id}', [EIController::class, 'destroy'])->name('destroy');
