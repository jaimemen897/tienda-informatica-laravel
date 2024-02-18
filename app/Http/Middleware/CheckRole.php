<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{

    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! $request->user()->hasAnyRole($roles)) {
            return redirect()->back()->withErrors('No tienes permisos para acceder a esta página');
        }

        return $next($request);
    }
}
