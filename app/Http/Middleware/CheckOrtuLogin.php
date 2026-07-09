<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOrtuLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('ortu_login')) {
            return redirect('/login-ortu')
                ->with('gagal', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}