<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTrial
{
    public function handle(Request $request, Closure $next): Response
    {
        $empresa = auth()->user()->empresa;

        if (!$empresa) {
            return redirect()->route('login');
        }

        if ($empresa->status === 'trial' && $empresa->trial_ends_at && now()->greaterThan($empresa->trial_ends_at)) {
            if (!$request->routeIs('assinatura.index') && !$request->routeIs('logout')) {
                session()->flash('erro', 'Seu período de teste expirou. Escolha um plano para continuar usando o StockFlow.');
                return redirect()->route('assinatura.index');
            }
        }

        return $next($request);
    }
}