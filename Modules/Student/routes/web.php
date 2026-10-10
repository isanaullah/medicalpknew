<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/Route::get('/test-route', function() {
    return 'Route is working!';
});

Route::prefix('student')->name('student.')->middleware(['auth'])->group(function () {

  // Dashboard
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

    // My Courses
    Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/course/{id}', [StudentController::class, 'courseDetail'])->name('course.detail');

    // My Notes
    Route::get('/notes', [StudentController::class, 'notes'])->name('notes');
    Route::get('/note/{id}', [StudentController::class, 'noteDetail'])->name('note.detail');

    // Tests
    Route::get('/tests', [StudentController::class, 'tests'])->name('tests');

    // My Orders
    Route::get('/orders', [StudentController::class, 'orders'])->name('orders');
    Route::get('/order/{id}', [StudentController::class, 'orderDetail'])->name('order.detail');
    Route::post('/order/{id}/upload-proof', [StudentController::class, 'uploadPaymentProof'])->name('order.upload-proof');

    // Settings
    Route::get('/settings', [StudentController::class, 'settings'])->name('settings');
    Route::post('/settings/profile', [StudentController::class, 'updateProfile'])->name('settings.profile');


});
