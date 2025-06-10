<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WishlistItemController;
use App\Http\Controllers\WishlistCategoryController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReminderController;   // <-- Ditambahkan
use App\Http\Controllers\AttachmentController; // <-- Ditambahkan

// Redirect root route to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Registration routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// --- Authenticated Routes ---
Route::middleware('auth')->group(function () { // Grouping authenticated routes
    // Wishlist Items (CRUD)
    Route::resource('wishlist-items', WishlistItemController::class);

    // Wishlist Categories (CRUD)
    Route::resource('wishlist-categories', WishlistCategoryController::class);

    // Progress (CRUD terbatas: create, store, destroy)
    Route::get('/wishlist-items/{wishlistItem}/progresses/create', [ProgressController::class, 'create'])->name('progresses.create');
    Route::post('/wishlist-items/{wishlistItem}/progresses', [ProgressController::class, 'store'])->name('progresses.store');
    Route::delete('/progresses/{progress}', [ProgressController::class, 'destroy'])->name('progresses.destroy');

    // Reminders (nested under wishlist-items) - Diperbarui
    Route::post('/wishlist-items/{wishlistItem}/reminders', [ReminderController::class, 'store'])->name('wishlist-items.reminders.store');

    // Attachments (nested under wishlist-items) - Diperbarui
    Route::post('/wishlist-items/{wishlistItem}/attachments', [AttachmentController::class, 'store'])->name('wishlist-items.attachments.store');

    // Anda bisa tambahkan route lain di sini jika ada
});