<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Models\Job  ;             

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- ΔΗΜΟΣΙΕΣ ΣΕΛΙΔΕΣ (FRONTEND) ---

// Η αρχική σελίδα καλεί πλέον την index του Controller (που φέρνει τις ενεργές αγγελίες)
Route::get('/', [ApplicationController::class, 'index'])->name('home');

// Σελίδες Αίτησης
Route::get('/apply/{id}', [ApplicationController::class, 'show'])->name('apply.show');
Route::post('/apply/{id}', [ApplicationController::class, 'store'])->name('apply.store');

// Στατικές Σελίδες
Route::view('/terms', 'terms')->name('terms');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/contact', 'contact')->name('contact');


// --- AUTHENTICATION ---

Route::get('/login', [ApplicationController::class, 'loginForm'])->name('login');
Route::post('/login', [ApplicationController::class, 'doLogin'])->name('login.post');
Route::get('/logout', [ApplicationController::class, 'logout'])->name('logout');


// --- ADMIN DASHBOARD (BACKEND) ---

Route::middleware(['auth'])->group(function () {
    // Κεντρικό Dashboard με τα φίλτρα
    Route::get('/dashboard', [ApplicationController::class, 'dashboard'])->name('dashboard');

    // Διαχείριση Αγγελιών
    Route::get('/jobs/create', [ApplicationController::class, 'createJob'])->name('jobs.create');
    Route::post('/jobs/store', [ApplicationController::class, 'storeJob'])->name('jobs.store');

    // Ενέργειες Υποψηφίων
    Route::get('/dashboard/analyze/{id}', [ApplicationController::class, 'analyze'])->name('dashboard.analyze');
    Route::post('/dashboard/status/{id}', [ApplicationController::class, 'updateStatus'])->name('dashboard.status');
});