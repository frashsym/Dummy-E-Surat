<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $roleType  // 'admin' or 'user'
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $roleType = null): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Definisi role
        $adminRoles = ['Pimpinan', 'Prodi'];
        $userRoles = ['Dosen', 'Mahasiswa'];

        $roleName = optional($user->role)->nama_role;

        $isAdmin = in_array($roleName, $adminRoles, true);
        $isUser = in_array($roleName, $userRoles, true);

        // Jika tidak diberikan parameter, biarkan lewat (atau ubah sesuai kebutuhan)
        if (is_null($roleType)) {
            return $next($request);
        }

        // role:user -> allow both user AND admin
        if ($roleType === 'user') {
            if (!($isUser || $isAdmin)) {
                abort(403, 'Anda tidak memiliki akses user.');
            }

            return $next($request);
        }

        // role:admin -> hanya admin
        if ($roleType === 'admin') {
            if (!$isAdmin) {
                abort(403, 'Anda tidak memiliki akses admin.');
            }

            return $next($request);
        }

        // Jika diberikan roleType lain yang tidak dikenali, tolak (opsional)
        abort(403, 'Akses ditolak.');
    }
}
