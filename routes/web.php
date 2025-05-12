<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Courses;
use App\Livewire\CourseDetail;
use App\Livewire\Enrollments;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/courses', Courses::class)->name('courses');
    Route::get('/courses/{course}', CourseDetail::class)->name('courses.show');
    Route::get('/enroll/{course}', Enrollments::class)->name('enroll');
});

require __DIR__.'/auth.php';
