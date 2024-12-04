<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PublicResumeController; // Import PublicResumeController
use Illuminate\Support\Facades\Route;

// Home page (redirects unauthenticated users to login)
Route::get('/', function () {
    return redirect()->route('login');  // Redirect unauthenticated users to login page
})->middleware('guest'); // Only for guests, unauthenticated users will be redirected to login

// Dashboard route (redirects to resumes if authenticated)
Route::get('/dashboard', function () {
    return redirect()->route('resumes.index');  // Ensure 'resumes.index' exists
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (only accessible to authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resume Routes (only accessible to authenticated users)
Route::middleware('auth')->group(function () {
    Route::resource('resumes', ResumeController::class); // CRUD for resumes
});

// Application Tracker Routes (only accessible to authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/resumes/{resume}/tracker', [ApplicationController::class, 'show'])->name('tracker.show'); // Tracker page
    Route::post('/resumes/{resume}/tracker', [ApplicationController::class, 'store'])->name('tracker.store');
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('tracker.update');
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('tracker.destroy');
});

// Publicly accessible route for viewing resumes (public view)
Route::get('/resumes/{resume}', [PublicResumeController::class, 'show'])->name('resumes.public');

// Route for previewing a resume (uses show.blade.php)
Route::get('/resumes/{resume}/preview', [ResumeController::class, 'show'])->name('resumes.show');

// Auth Routes (accessible to guests only)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');  // Name the route for redirection

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');  // Name the route for redirection
});

require __DIR__.'/auth.php';