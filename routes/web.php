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
Route::get('/staff', [UserController::class, 'index'])->name('user.index');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    // ================= ROLE MANAGEMENT (Hanya Superadmin) =================
    Route::resource('/role', RoleController::class)
        ->middleware('role:superadmin')
        ->names([
            'index' => 'role.index',
            'store' => 'role.store',
            'show' => 'role.show',
            'update' => 'role.update',
            'destroy' => 'role.destroy',
        ]);

    // ================= SURAT AREA (Dipakai admin & user) =================
    Route::prefix('surat')->group(function () {

        Route::get('/', [SuratController::class, 'index'])->name('surat.index');

        Route::get('/{template:slug}', [SuratController::class, 'show'])->name('surat.show');

        Route::post('/{template}', [SuratController::class, 'store'])->name('surat.store');
    });

    // ================= STAFF MANAGEMENT KHUSUS ADMIN =================
    Route::resource('/staff', UserController::class)
        ->only(['store', 'update', 'destroy'])
        ->middleware('role:admin');


    // Route::post('/notifications/read', function () {
    //     Auth::user()->unreadNotifications->markAsRead();
    //     return back();
    // })->name('notifications.read');

});

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
