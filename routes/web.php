<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; // Humara AdminController import kar rahe hain

Route::get('/', function () {
    return view('welcome');
    
});
// ================= ADMIN ROUTES =================

// Register
Route::get('/admin/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'register']);

// Login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

// Dashboard (sirf logged-in admin access kar sake)
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
