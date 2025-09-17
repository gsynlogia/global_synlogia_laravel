<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MagicLinkController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/o-firmie', function () {
    return view('pages.about');
});

Route::get('/uslugi', function () {
    return view('pages.services');
});

Route::get('/kontakt', function () {
    return view('pages.contact');
});

Route::get('/blog', function () {
    return view('pages.blog');
});

// Authentication routes
Route::get('/login', [MagicLinkController::class, 'showLinkRequestForm'])->name('login')->middleware('guest');
Route::post('/login', [MagicLinkController::class, 'sendMagicLink'])->name('login.send')->middleware('guest');
Route::get('/auth/verify/{token}', [MagicLinkController::class, 'verifyMagicLink'])->name('auth.verify');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::post('/logout', [MagicLinkController::class, 'logout'])->name('logout');
});

// Admin routes (only for superusers)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin');
});
