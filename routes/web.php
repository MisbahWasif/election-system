<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; // Humara AdminController import kar rahe hain
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ResultController;

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
    // ================= CANDIDATE ROUTES =================
Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
Route::get('/candidates/create', [CandidateController::class, 'create'])->name('candidates.create');
Route::post('/candidates', [CandidateController::class, 'store'])->name('candidates.store');
Route::get('/candidates/{candidate}/edit', [CandidateController::class, 'edit'])->name('candidates.edit');
Route::put('/candidates/{candidate}', [CandidateController::class, 'update'])->name('candidates.update');
Route::delete('/candidates/{candidate}', [CandidateController::class, 'destroy'])->name('candidates.destroy');
// ================= RESULT ROUTES =================
Route::get('/results', [ResultController::class, 'index'])->name('results.index');
Route::get('/results/{election}', [ResultController::class, 'show'])->name('results.show');
});
// ================= VOTER ROUTES =================
Route::get('/voter/register', [VoterController::class, 'showRegisterForm'])->name('voter.register');
Route::post('/voter/register', [VoterController::class, 'register']);

Route::get('/voter/login', [VoterController::class, 'showLoginForm'])->name('voter.login');
Route::post('/voter/login', [VoterController::class, 'login']);

Route::middleware('auth:voter')->group(function () {
    Route::get('/voter/dashboard', [VoterController::class, 'dashboard'])->name('voter.dashboard');
    Route::post('/voter/logout', [VoterController::class, 'logout'])->name('voter.logout');

    // ================= VOTING ROUTES =================
    Route::get('/vote', [VoteController::class, 'index'])->name('vote.index');
    Route::get('/vote/{election}', [VoteController::class, 'showCandidates'])->name('vote.candidates');
    Route::post('/vote/{election}', [VoteController::class, 'castVote'])->name('vote.cast');
});