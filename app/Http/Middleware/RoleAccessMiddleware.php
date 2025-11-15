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

        // Ambil nama role dari relasi user->role
        $roleName = optional($user->role)->nama_role;

        // Role yang dianggap admin
        $adminRoles = ['Superadmin'];

        // Role yang boleh fitur user
        $userRoles  = ['Superadmin', 'Pimpinan', 'Prodi', 'Dosen', 'Mahasiswa'];

        // Superadmin → bisa SEMUA ROUTE tanpa pengecekan lain
        if ($roleName === 'Superadmin') {
            return $next($request);
        }

        // Kalau route ini butuh role admin
        if ($roleType === 'admin') {
            if (!in_array($roleName, $adminRoles)) {
                abort(403, 'Akses admin ditolak.');
            }
            return $next($request);
        }

        // Kalau route ini butuh role user
        if ($roleType === 'user') {
            if (!in_array($roleName, $userRoles)) {
                abort(403, 'Akses user ditolak.');
            }
            return $next($request);
        }

        // Jika tidak ada parameter → lewati saja
        return $next($request);
    }
}
