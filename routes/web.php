<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
require __DIR__.'/auth.php';

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Calendario y vacaciones (para todos los usuarios)
    Route::get('/calendar', [VacationController::class, 'index'])->name('calendar');
    Route::post('/vacations', [VacationController::class, 'store'])->name('vacations.store');
    Route::delete('/vacations/{vacation}', [VacationController::class, 'destroy'])->name('vacations.destroy');

    // Rutas solo para administradores
    Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
        // Panel de administración
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Gestión de usuarios
        Route::prefix('users')->group(function () {
            Route::get('/', [AdminController::class, 'users'])->name('admin.users.index');
            Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
            Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
        });
        
        // Gestión de áreas
        Route::prefix('areas')->group(function () {
            Route::get('/', [AreaController::class, 'index'])->name('admin.areas.index');
            Route::get('/{area}', [AreaController::class, 'show'])->name('admin.areas.show');
        });
        
        // Aprobación de vacaciones
        Route::post('/vacations/{vacation}/approve', [VacationController::class, 'approve'])
             ->name('admin.vacations.approve');
        Route::post('/vacations/{vacation}/reject', [VacationController::class, 'reject'])
             ->name('admin.vacations.reject');
    });

    // Notificaciones
    Route::post('/notifications/{notification}/mark-as-read', function ($notificationId) {
        Auth::user()->notifications()->where('id', $notificationId)->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    })->name('notifications.markAsRead');

    Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
        
        Route::delete('vacations/{vacation}', [VacationController::class, 'destroy'])
             ->name('admin.vacations.destroy');
    });

// routes/web.php
Route::post('/vacations/{id}/approve', [VacationController::class, 'approve'])
     ->name('vacations.approve');

Route::post('/vacations/{id}/reject', [VacationController::class, 'reject'])
     ->name('vacations.reject');
});