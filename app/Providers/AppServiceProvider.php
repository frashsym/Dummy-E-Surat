<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\View\Composers\NotifikasiSuratComposer;

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


    public function boot()
    {
        Carbon::setLocale('id');
        Blade::if('superadmin', function () {
            return Auth::check() && Auth::user()->role->nama_role === 'Superadmin';
        });
        View::composer('*', NotifikasiSuratComposer::class);
    }

}
