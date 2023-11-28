<?php

use App\Http\Controllers\CourseController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/course/create', [CourseController::class, 'create']);
    Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::patch('/courses/update', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
});



