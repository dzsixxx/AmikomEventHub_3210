<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     * Ini adalah jawaban untuk Soal 8.5 Nomor 3
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login DAN role-nya adalah 'admin', persilakan masuk
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin (atau belum login), tendang kembali ke halaman depan atau login
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}