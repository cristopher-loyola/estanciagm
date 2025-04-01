<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\PermisoEconomicoController;
use App\Http\Controllers\Admin\EconomicPermissionController;
use App\Http\Controllers\Admin\EconomicPermission;


Route::get('/', function () {
    return view('welcome');
});

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

Route::post('/vacations/{id}/approve', [VacationController::class, 'approve'])
     ->name('vacations.approve');

Route::post('/vacations/{id}/reject', [VacationController::class, 'reject'])
     ->name('vacations.reject');


     Route::middleware('auth')->group(function () {
         Route::get('/permisos-economicos', [PermisoEconomicoController::class, 'index'])->name('permisos-economicos.index');
         Route::post('/permisos-economicos', [PermisoEconomicoController::class, 'store'])->name('permisos-economicos.store');
     });

     Route::prefix('admin')->middleware(['auth', 'isAdmin'])->name('admin.')->group(function () {
        // Rutas para permisos económicos
        Route::get('economic-permissions', [EconomicPermissionController::class, 'index'])
            ->name('economic-permissions.index');
    
        Route::post('economic-permissions/{permission}/approve', [EconomicPermissionController::class, 'approve'])
            ->name('economic-permissions.approve');
    
        Route::post('economic-permissions/{permission}/reject', [EconomicPermissionController::class, 'reject'])
            ->name('economic-permissions.reject');
    
        // Ruta para eliminar un permiso económico
        Route::delete('economic-permissions/{permission}', [EconomicPermissionController::class, 'destroy'])
            ->name('economic-permissions.destroy');
    });
    
///////////////////////////


Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function() {
    // Selector de áreas
    Route::get('/economic-permissions/areas', [EconomicPermissionController::class, 'selectArea'])
         ->name('economic-permissions.select-area');
    
    // Permisos por área
    Route::get('/economic-permissions/area/{area}', [EconomicPermissionController::class, 'byArea'])
         ->name('economic-permissions.by-area');
    
    // ... tus otras rutas existentes ...
});
});