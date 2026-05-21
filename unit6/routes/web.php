<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illumitae\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/abc',[EIcontroller::class,'index']);
// Dashboard
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/api/data', [DashboardController::class, 'getData'])->name('api.data');

// // Courses
// Route::prefix('courses')->name('courses.')->group(function () {
//     Route::get('/', [CourseController::class, 'index'])->name('index');
//     Route::get('/create', [CourseController::class, 'create'])->name('create');
//     Route::post('/', [CourseController::class, 'store'])->name('store');
//     Route::get('/{id}', [CourseController::class, 'show'])->name('show');
//     Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [CourseController::class, 'update'])->name('update');
//     Route::delete('/{id}', [CourseController::class, 'destroy'])->name('destroy');
//     Route::get('/stats/overview', [CourseController::class, 'stats'])->name('stats');
// });

// // Users
// Route::prefix('users')->name('users.')->group(function () {
//     Route::get('/', [UserController::class, 'index'])->name('index');
//     Route::get('/{id}', [UserController::class, 'show'])->name('show');
//     Route::post('/{id}/enroll', [UserController::class, 'enrollCourse'])->name('enroll');
//     Route::put('/{id}/progress', [UserController::class, 'updateProgress'])->name('update.progress');
//     Route::delete('/{userId}/courses/{courseId}', [UserController::class, 'removeFromCourse'])->name('remove.course');
//     Route::get('/stats/enrollments', [UserController::class, 'enrollmentStats'])->name('stats');
// });

