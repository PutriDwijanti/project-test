<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\Agent\TicketController as AgentTicketController;

// ✅ Route awal ke halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// ✅ Autentikasi (login/register)
require __DIR__.'/auth.php';

// ✅ Dashboard utama, akan diarahkan berdasarkan role dari controller
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// ✅ Route yang hanya bisa diakses saat sudah login
Route::middleware('auth')->group(function () {

    // ✅ Resource routes
    Route::resource('tickets', TicketController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('labels', LabelController::class);
    Route::resource('users', UserController::class);
    Route::resource('logs', LogController::class);

    // ✅ Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Route khusus untuk agent
Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [AgentTicketController::class, 'dashboard'])->name('dashboard');
    
    // Resource ticket agent (index, show, edit, update, tanpa create dan destroy)
    Route::resource('tickets', AgentTicketController::class)->except(['create', 'store', 'destroy']);

    // Route untuk menambahkan komentar ke tiket agen
    Route::post('tickets/{ticket}/comment', [AgentTicketController::class, 'addComment'])->name('tickets.comment');
});

// ✅ Route khusus untuk user biasa
Route::middleware(['auth', 'role:user'])->get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
