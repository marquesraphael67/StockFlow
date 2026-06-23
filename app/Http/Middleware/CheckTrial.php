<?php

namespace App\Http\Middleware;

use App\Models\Assinatura;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTrial
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || !$user->empresa) {
            return redirect()->route('home');
        }

        $empresa = $user->empresa;

        $assinatura = Assinatura::where('empresa_id', $empresa->id)
            ->latest()
            ->first();

        if (!$assinatura) {
            $assinatura = Assinatura::create([
                'empresa_id' => $empresa->id,
                'plano' => 'basico',
                'valor' => 0,
                'status' => 'trial',
                'data_inicio' => now(),
                'data_expiracao' => now()->addDays(7),
            ]);
        }

        if (
            in_array($assinatura->status, ['trial', 'ativo']) &&
            $assinatura->data_expiracao &&
            now()->lessThanOrEqualTo($assinatura->data_expiracao)
        ) {
            return $next($request);
        }

        $assinatura->update([
            'status' => 'expirado',
        ]);

        $empresa->update([
            'status' => 'expirado',
            'ativo' => false,
        ]);

        return redirect()->route('assinatura.index')
            ->with('erro', 'Sua assinatura expirou. Escolha um plano para continuar usando o StockFlow.');
    }
}