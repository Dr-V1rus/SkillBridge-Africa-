<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register/business', function () {
    return view('auth.register', ['role' => 'business']);
})->name('register.business');

Route::get('/features', function () {
    return view('pages.features');
})->name('features');

Route::get('/how-it-works', function () {
    return view('pages.how-it-works');
})->name('how-it-works');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'business') {
        return view('dashboards.business');
    }

    $applications     = Auth::user()->applications ?? collect();
    $internshipsCount = \App\Models\Internship::where('is_active', true)->count();

    return view('dashboard', compact('applications', 'internshipsCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index');
    Route::get('/internships/create', [InternshipController::class, 'create'])->name('internships.create');
    Route::post('/internships', [InternshipController::class, 'store'])->name('internships.store');
    Route::get('/internships/{internship}', [InternshipController::class, 'show'])->name('internships.show');
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/create/{internship}', [ApplicationController::class, 'create'])->name('applications.create');
});

require __DIR__ . '/auth.php';
