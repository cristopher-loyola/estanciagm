<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AreaController;


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

require __DIR__.'/auth.php';



