<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified',])->group(function () {

    Route::get('/index', [IndexController::class, 'index'])
        ->name('index');
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Karir
    Route::prefix('karir')->group(function () {
        Route::get('/', [KarirController::class, 'index'])->name('karir.karir');
        Route::post('/', [KarirController::class, 'store'])->name('karir.store');
        Route::put('/{karir}', [KarirController::class, 'update'])->name('karir.update');
        Route::delete('/{karir}', [KarirController::class, 'destroy'])->name('karir.destroy');
    });

    // Layanan
    Route::prefix('layanan')->group(function () {
        Route::get('/', [LayananController::class, 'index'])->name('layanan.layanan');
        Route::post('/', [LayananController::class, 'store'])->name('layanan.store');
        Route::get('/{layanan}', [LayananController::class, 'show'])->name('layanan.show');
        Route::put('/{layanan}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/{layanan}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    });

    // Role
    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.role');
        Route::post('/', [RoleController::class, 'store'])->name('role.store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('role.show');
        Route::put('/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    // Surat
    Route::prefix('surat')->group(function () {
        Route::get('/', [SuratController::class, 'index'])->name('surat.surat');
        Route::post('/', [SuratController::class, 'store'])->name('surat.store');
        Route::get('/{surat}', [SuratController::class, 'show'])->name('surat.show');
        Route::put('/{surat}', [SuratController::class, 'update'])->name('surat.update');
        Route::delete('/{surat}', [SuratController::class, 'destroy'])->name('surat.destroy');
    });

    // User
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.user');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
        Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
