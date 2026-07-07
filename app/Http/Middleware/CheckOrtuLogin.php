<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOrtuLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            !session()->has('is_logged_in') ||
            session('role') != 'orang_tua'
        ) {
            return redirect('/login-ortu')
                ->with('gagal', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}