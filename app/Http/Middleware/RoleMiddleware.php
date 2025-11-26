<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Role Middleware - Middleware untuk mengecek role/peran user
 * 
 * Middleware ini berfungsi untuk memastikan user yang mengakses route
 * memiliki role/peran yang sesuai dengan yang ditentukan.
 * 
 * Cara penggunaan di route:
 * Route::middleware(['auth', 'role:admin'])->group(function () { ... });
 * Route::middleware(['auth', 'role:karyawan'])->group(function () { ... });
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request - HTTP request dari user
     * @param  \Closure  $next - Fungsi untuk melanjutkan ke middleware/controller berikutnya
     * @param  string  ...$roles - Role yang diizinkan (contoh: 'admin', 'karyawan')
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        /**
         * PENGECEKAN ROLE:
         * 1. $request->user()->role → Mengambil role user yang sedang login
         * 2. in_array() → Cek apakah role user ada di array $roles yang diizinkan
         * 
         * Contoh:
         * - Route: middleware(['role:admin'])
         * - User login dengan role: 'karyawan'
         * - in_array('karyawan', ['admin']) → false
         * - Maka akan abort(403)
         */
        if (!in_array($request->user()->role, $roles)) {
            // abort(403) = Error 403 Forbidden (Akses Ditolak)
            abort(403, 'Unauthorized access.');
        }
        
        // Jika role sesuai, lanjutkan ke controller
        return $next($request);
    }
}
