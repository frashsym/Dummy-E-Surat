<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    // ================== ADMIN AREA ==================
    Route::prefix('admin')->middleware('role:admin')->group(function () {

        // Role
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
            Route::post('/', [RoleController::class, 'store'])->name('admin.role.store');
            Route::get('/{role}', [RoleController::class, 'show'])->name('admin.role.show');
            Route::put('/{role}', [RoleController::class, 'update'])->name('admin.role.update');
            Route::delete('/{role}', [RoleController::class, 'destroy'])->name('admin.role.destroy');
        });

        // User CRUD
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
            Route::put('/{user}', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        });
    });

    // ================== USER AREA ==================
    Route::prefix('user')->middleware('role:user')->group(function () {

        // User hanya read data
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/detail/{user}', [UserController::class, 'show'])->name('user.show');

        // Surat (CRUD untuk user)
        Route::prefix('surat')->group(function () {
            Route::get('/', [SuratController::class, 'index'])->name('user.surat.index');
            Route::post('/', [SuratController::class, 'store'])->name('user.surat.store');
            Route::get('/{surat}', [SuratController::class, 'show'])->name('user.surat.show');
            Route::put('/{surat}', [SuratController::class, 'update'])->name('user.surat.update');
        });
    });
});

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
