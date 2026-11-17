<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Akses ditolak. Fitur manajemen akun hanya dapat diakses oleh Administrator Utama.');
        }

        return $next($request);
    }
}
