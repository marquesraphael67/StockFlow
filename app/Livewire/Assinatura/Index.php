<?php

namespace App\Livewire\Assinatura;

use Livewire\Component;

class Index extends Component
{
    public function alterarPlano($plano)
    {
        auth()->user()->empresa->update([
            'plano' => $plano,
        ]);

        session()->flash('success', 'Plano alterado com sucesso!');
    }

    public function render()
    {
        return view('livewire.assinatura.index', [
            'empresa' => auth()->user()->empresa,
        ])->layout('layouts.app');
    }
}