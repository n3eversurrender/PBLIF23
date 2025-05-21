<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class PeranMiddleware
{
    public function handle(Request $request, Closure $next, string $peran): mixed
    {
        if (Auth::check() && Auth::user()->peran === $peran) {
            Log::info('Akses diizinkan untuk peran: ' . $peran);
            return $next($request);
        }

        Log::warning('Akses ditolak. Peran: ' . ($request->user()?->peran ?? 'tidak ada') . ', Diharapkan: ' . $peran);
        return redirect('/')->withErrors('Anda tidak memiliki akses ke halaman ini.');
    }
}
