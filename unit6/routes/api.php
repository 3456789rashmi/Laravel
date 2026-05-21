<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::prefix('api')->group(function () {
    // Courses
    Route::get('/courses', [ApiController::class, 'getCourses']);
    Route::get('/courses/{id}', [ApiController::class, 'getCourse']);

    // Users
    Route::get('/users', [ApiController::class, 'getUsers']);
    Route::get('/users/{id}', [ApiController::class, 'getUser']);

    // Enrollments
    Route::get('/enrollments', [ApiController::class, 'getEnrollments']);

    // Statistics
    Route::get('/stats', [ApiController::class, 'getStats']);

});
