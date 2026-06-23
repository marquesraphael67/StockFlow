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
            return redirect()->route('home');
        }

        if ($empresa->status === 'ativo') {
            return $next($request);
        }

        if ($empresa->status === 'trial' && $empresa->trial_ends_at && now()->lessThanOrEqualTo($empresa->trial_ends_at)) {
            return $next($request);
        }

        $empresa->update([
            'status' => 'expirado',
            'ativo' => false,
        ]);

        return redirect()->route('assinatura.index')
            ->with('erro', 'Seu teste grátis expirou. Escolha um plano para continuar usando o StockFlow.');
    }
}