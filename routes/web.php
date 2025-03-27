<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\VacationController;



Route::post('/vacations/store', [VacationController::class, 'store'])->name('vacations.store');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/users', [UserController::class, 'store'])
         ->middleware('can:create-users'); // Aplica el Gate
});


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
});



Route::get('/calendar', function () {
    return view('calendar');
});


Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');









Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    
    Route::get('/admin/areas', [AreaController::class, 'index'])->name('admin.areas.index');
    Route::get('/admin/areas/{area}', [AreaController::class, 'show'])->name('admin.areas.show');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/areas', [AreaController::class, 'index'])->name('admin.areas.index');
});

Route::get('/admin/crear-usuario', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/guardar-usuario', [UserController::class, 'store'])->name('admin.users.store');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/vacations/{vacation}/approve', [VacationController::class, 'approve'])->name('vacations.approve');
    Route::post('/vacations/{vacation}/reject', [VacationController::class, 'reject'])->name('vacations.reject');
});

Route::get('/admin/vacations', [VacationController::class, 'index'])->name('vacations.index')->middleware('admin');

Route::post('/vacations/{vacation}/approve', [VacationController::class, 'approve'])->name('vacations.approve');
Route::post('/vacations/{vacation}/reject', [VacationController::class, 'reject'])->name('vacations.reject');



Route::post('/notifications/{notification}/mark-as-read', function ($notificationId) {
    Auth::user()->notifications()->where('id', $notificationId)->update(['read_at' => now()]);
    return response()->json(['success' => true]);
})->middleware('auth')->name('notifications.markAsRead');

Route::post('/notifications/{notification}/mark-as-read', function ($notificationId) {
    Auth::user()->notifications()->where('id', $notificationId)->update(['read_at' => now()]);
    return response()->json(['success' => true]);
})->middleware('auth')->name('notifications.markAsRead');


Route::get('/calendar', [CalendarController::class, 'index'])
->name('calendar')->middleware('auth');


Route::delete('/vacations/{vacation}', [VacationController::class, 'destroy'])
    ->name('vacations.destroy')
    ->middleware('auth');
    



// routes/web.php
Route::middleware(['auth'])->group(function () {
    // Aprobar vacaciones
    Route::post('/vacations/{vacation}/approve', [VacationController::class, 'approve'])
         ->name('vacations.approve');
    
    // Rechazar vacaciones
    Route::post('/vacations/{vacation}/reject', [VacationController::class, 'reject'])
         ->name('vacations.reject');
    
    // Eliminar vacaciones
    Route::delete('/vacations/{vacation}', [VacationController::class, 'destroy'])
         ->name('vacations.destroy');
});
require __DIR__.'/auth.php';



