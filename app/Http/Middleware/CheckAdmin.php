<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->tipo !== 'admin') {
            return redirect()
                ->route('dashboard')
                ->with('erro', 'Você não tem permissão para acessar esta página.');
        }

        return $next($request);
    }
}