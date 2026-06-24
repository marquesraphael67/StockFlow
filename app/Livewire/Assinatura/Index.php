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

        $assinatura = Assinatura::firstOrCreate(
            ['empresa_id' => $empresa->id],
            [
                'plano' => $empresa->plano ?? 'basico',
                'valor' => 0,
                'status' => 'trial',
                'data_inicio' => now(),
                'data_expiracao' => now()->addDays(7),
            ]
        );

        $diasTrial = $assinatura->data_expiracao
            ? max(0, ceil(now()->diffInHours($assinatura->data_expiracao, false) / 24))
            : 0;

        $ultimoPagamento = Pagamento::where('empresa_id', $empresa->id)
            ->latest()
            ->first();

        $pagamentos = Pagamento::where('empresa_id', $empresa->id)
            ->latest()
            ->get();

        $planos = [
            'basico' => [
                'nome' => 'Básico',
                'valor' => 39,
                'limite' => '1 usuário',
                'descricao' => 'Ideal para começar a controlar o estoque.',
                'recursos' => [
                    '1 usuário',
                    'Produtos e clientes',
                    'Vendas e estoque',
                    'Relatórios básicos',
                ],
            ],
            'pro' => [
                'nome' => 'Pro',
                'valor' => 79,
                'limite' => '5 usuários',
                'descricao' => 'Mais completo para pequenos comércios.',
                'recursos' => [
                    'Até 5 usuários',
                    'Produtos ilimitados',
                    'Dashboard avançado',
                    'Relatórios completos',
                ],
            ],
            'premium' => [
                'nome' => 'Premium',
                'valor' => 149,
                'limite' => 'Usuários ilimitados',
                'descricao' => 'Controle profissional para empresas maiores.',
                'recursos' => [
                    'Usuários ilimitados',
                    'Dashboard premium',
                    'Relatórios PDF',
                    'Suporte prioritário',
                ],
            ],
        ];

        return view('livewire.assinatura.index', compact(
            'empresa',
            'assinatura',
            'diasTrial',
            'ultimoPagamento',
            'pagamentos',
            'planos'
        ))->layout('layouts.app');
    }
}