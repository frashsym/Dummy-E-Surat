<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccessMiddleware
{
    public function handle(Request $request, Closure $next, $roleType = null): Response
    {
        $user = $request->user();

        // belum login → ke home
        if (!$user) {
            return redirect('/');
        }

        $roleName = optional($user->role)->nama_role;

        $superadminOnly = ['Superadmin'];
        $adminRoles = ['Superadmin', 'Admin'];
        $userRoles = ['Superadmin', 'Admin', 'Pimpinan', 'Prodi', 'Dosen', 'Mahasiswa'];

        // Superadmin bypass semua
        if ($roleName === 'Superadmin') {
            return $next($request);
        }

        // Superadmin only
        if ($roleType === 'superadmin') {
            return in_array($roleName, $superadminOnly)
                ? $next($request)
                : redirect('/');
        }

        // Admin area
        if ($roleType === 'admin') {
            return in_array($roleName, $adminRoles)
                ? $next($request)
                : redirect('/');
        }

        // User area
        if ($roleType === 'user') {
            return in_array($roleName, $userRoles)
                ? $next($request)
                : redirect('/');
        }

        // default
        return $next($request);
    }
}
