<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TemplateSuratController;
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

        // User hanya bisa melihat daftar user
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/detail/{user}', [UserController::class, 'show'])->name('user.show');

        // Halaman daftar template surat (card)
        Route::prefix('surat/template')->name('user.template.')->group(function () {

            // LIST TEMPLATE
            Route::get('/', [TemplateSuratController::class, 'index'])->name('index');

            // ADD TEMPLATE
            Route::post('/', [TemplateSuratController::class, 'store'])->name('store');

            // SHOW TEMPLATE
            Route::get('/{template}', [TemplateSuratController::class, 'show'])->name('show');
        });

        Route::prefix('surat')->name('user.surat.')->group(function () {

            // LIST TEMPLATE
            Route::get('/', [SuratController::class, 'index'])->name('index');

            // FORM MENGISI TEMPLATE → BIKIN SURAT BARU
            Route::post('/buat/{template}', [SuratController::class, 'store'])->name('store');

            // UPDATE SURAT YANG SUDAH ADA
            Route::put('/edit/{surat}', [SuratController::class, 'update'])->name('update');
        });

    });

    Route::post('/notifications/read', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.read');

});

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
