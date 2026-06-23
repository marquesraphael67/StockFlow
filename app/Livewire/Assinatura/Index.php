<?php

namespace App\Livewire\Assinatura;

use App\Models\Assinatura;
use App\Models\Pagamento;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $empresa = auth()->user()->empresa;

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

        $diasTrial = $assinatura->data_expiracao
            ? max(0, ceil(now()->diffInHours($assinatura->data_expiracao, false) / 24))
            : 0;

        $ultimoPagamento = Pagamento::where('empresa_id', $empresa->id)
            ->latest()
            ->first();

        return view('livewire.assinatura.index', [
            'empresa' => $empresa,
            'assinatura' => $assinatura,
            'diasTrial' => $diasTrial,
            'ultimoPagamento' => $ultimoPagamento,
            'pagamentos' => Pagamento::where('empresa_id', $empresa->id)
                ->latest()
                ->get(),
        ])->layout('layouts.app');
    }
}