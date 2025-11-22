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
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $roleName = optional($user->role)->nama_role;

        // ROLE GROUPING
        $superadminOnly = ['Superadmin'];
        $adminRoles     = ['Superadmin', 'Administrator'];
        $userRoles      = ['Superadmin', 'Administrator', 'Pimpinan', 'Prodi', 'Dosen', 'Mahasiswa'];

        // ============ ROLE LOGIC ============

        // superadmin → bypass semua
        if ($roleName === 'Superadmin') {
            return $next($request);
        }

        // superadmin only routes
        if ($roleType === 'superadmin') {
            if (!in_array($roleName, $superadminOnly)) {
                abort(403, 'Hanya Superadmin.');
            }
            return $next($request);
        }

        // admin routes (superadmin + administrator)
        if ($roleType === 'admin') {
            if (!in_array($roleName, $adminRoles)) {
                abort(403, 'Hanya Admin.');
            }
            return $next($request);
        }

        // user routes
        if ($roleType === 'user') {
            if (!in_array($roleName, $userRoles)) {
                abort(403, 'Hanya User.');
            }
            return $next($request);
        }

        // tanpa parameter → lolos
        return $next($request);
    }
}
