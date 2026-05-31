<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('user-home',[UserController::class,'userfunction']);
Route::get('user-about',[UserController::class,'userabout']);