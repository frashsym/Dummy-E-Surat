<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        Blade::if('admin', function () {
            $user = Auth::user();

            // Cek dulu apakah user login dan punya relasi role
            if ($user && $user->role) {
                return in_array($user->role->nama_role, ['Pimpinan', 'Prodi']);
            }

            return false; // kalau belum login, otomatis bukan admin
        });
    }

}
