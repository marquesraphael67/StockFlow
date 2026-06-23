<?php

namespace App\Livewire\Assinatura;

use App\Models\Pagamento;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $empresa = auth()->user()->empresa;

        $trialEnds = $empresa->trial_ends_at;
        $diasTrial = $trialEnds ? max(0, ceil(now()->diffInHours($trialEnds, false) / 24)) : 0;

        $ultimoPagamento = Pagamento::where('empresa_id', $empresa->id)
            ->latest()
            ->first();

        return view('livewire.assinatura.index', [
            'empresa' => $empresa,
            'diasTrial' => $diasTrial,
            'ultimoPagamento' => $ultimoPagamento,
            'pagamentos' => Pagamento::where('empresa_id', $empresa->id)
                ->latest()
                ->get(),
        ])->layout('layouts.app');
    }
}