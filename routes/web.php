<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentRegistrationController;
use Illuminate\Support\Facades\Route;
Route::get('/', fn () => auth()->check() ? redirect()->route('dashboard') : redirect()->route('login'));
Route::middleware('guest')->group(function () {
    Route::get('/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'login'])->name('login.store');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/courses',[CourseController::class,'index'])->name('courses.index');
    Route::get('/courses/{course}',[CourseController::class,'show'])->name('courses.show');
    Route::middleware('role:admin,lecturer')->group(function () {
        Route::get('/courses/create',[CourseController::class,'create'])->name('courses.create');
        Route::post('/courses',[CourseController::class,'store'])->name('courses.store');
        Route::get('/courses/{course}/edit',[CourseController::class,'edit'])->name('courses.edit');
        Route::put('/courses/{course}',[CourseController::class,'update'])->name('courses.update');
    });
    Route::middleware('role:admin')->group(function () {
        Route::resource('students',StudentController::class);
    });
    Route::middleware('role:admin,lecturer')->group(function () {
        Route::get('/registrations/create',[StudentRegistrationController::class,'create'])->name('registrations.create');
        Route::get('/registrations',[StudentRegistrationController::class,'index'])->name('registrations.index');
        Route::post('/registrations',[StudentRegistrationController::class,'store'])->name('registrations.store');
        Route::delete('/registrations/{registration}',[StudentRegistrationController::class,'destroy'])->name('registrations.destroy');
    });
    Route::middleware('role:student')->group(function () {
        Route::get('/my-registrations',[StudentRegistrationController::class,'index'])->name('my-registrations');
        Route::get('/available-courses',[StudentRegistrationController::class,'availableCourses'])->name('available-courses');
        Route::post('/my-registrations',[StudentRegistrationController::class,'store'])->name('my-registrations.store');
        Route::delete('/my-registrations/{registration}',[StudentRegistrationController::class,'destroy'])->name('my-registrations.destroy');
    });
    Route::middleware('role:admin')->delete('/courses/{course}',[CourseController::class,'destroy'])->name('courses.destroy');
});
