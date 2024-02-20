<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, $guard ="employee"): Response
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }
        return redirect()->back()->withErrors('No tienes permisos para acceder a esta página');
    }
}
