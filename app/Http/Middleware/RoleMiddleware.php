<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika user belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Jika role user tidak sesuai, arahkan ke halaman "no-access"
        if ($user->role !== $role) {
            return redirect()->route('no-access'); // Ganti dengan route yang benar
        }

        return $next($request);
    }
}
