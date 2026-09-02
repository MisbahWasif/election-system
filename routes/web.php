<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; // Humara AdminController import kar rahe hain
use App\Http\Controllers\ElectionController;

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

    // ================= ELECTION ROUTES =================
    Route::get('/elections', [ElectionController::class, 'index'])->name('elections.index');
    Route::get('/elections/create', [ElectionController::class, 'create'])->name('elections.create');
    Route::post('/elections', [ElectionController::class, 'store'])->name('elections.store');
    Route::put('/elections/{election}/status', [ElectionController::class, 'updateStatus'])->name('elections.updateStatus');
    Route::delete('/elections/{election}', [ElectionController::class, 'destroy'])->name('elections.destroy');
});
