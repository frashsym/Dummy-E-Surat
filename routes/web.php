<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/staff', [UserController::class, 'index'])->name('user.index');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA (SUPERADMIN + ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // STAFF MANAGEMENT
        Route::resource('/staff', UserController::class)
            ->only(['store', 'update', 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | SUPERADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:superadmin')->group(function () {

        Route::resource('/role', RoleController::class)
            ->names([
                'index' => 'role.index',
                'store' => 'role.store',
                'show' => 'role.show',
                'update' => 'role.update',
                'destroy' => 'role.destroy',
            ]);
    });

    /*
    |--------------------------------------------------------------------------
    | SURAT AREA (SEMUA USER LOGIN)
    |--------------------------------------------------------------------------
    */
    Route::prefix('surat')->group(function () {

        Route::get('/', [SuratController::class, 'index'])->name('surat.index');
        Route::get('/{template:slug}', [SuratController::class, 'show'])->name('surat.show');
        Route::post('/{template:slug}', [SuratController::class, 'store'])->name('surat.store');
    });
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
