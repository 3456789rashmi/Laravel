<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationEIController;

// Route::get('/', function () {
//     return "oops sorry!";
// });

// Route::prefix('223IS')->group(function(){
//     // Route::get('/', function () {
//     //     return "oops sorry!";
//     // });
//     Route::get('/university/{name}', [MyController::class, 'func1']);
//     Route::get('/details/{id}', [MyController::class, 'details']);
//     Route::get('/student/{name}', [MyController::class, 'show']);
// });

// Route::fallback(function () {
//     return "404 - Page Not Found!";
// }); 

// Route::get('/', function () {
//     return view('MyEIform');
// });
// Route::post('/submit',[validationEicontroller::class,'validate']);

// Task 2:
// SIYA working at google, developing a secure employee onboarding system using laravel.
// Since the system handles sensitive company data, she applies string built-in validation constraints 
// to ensure maximum security and correctness. a) The name field is mandatory , must contain only
// alphabets, and spaces, and should be between 5 and 10 characters. b) The email field is
// required, must follow a valid email format, belong to a specific company domain (e.g.
// @google.com), and must be unique in the database. c) The password field is compulsory, must 
// be at least 8 characters long, include at least one uppercase letter, one lowercase letter,
// one number, and one special character, and must match the confirmation field.
// d) The phone number field is required, must be numeric, and exactly 10 digits long.
// e) additionally the date of birth field is required and must esure that the employee is at least 
// 24 years old. 