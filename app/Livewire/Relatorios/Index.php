<?php

namespace App\Livewire\Relatorios;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $empresaId = auth()->user()->empresa_id;

        return view('livewire.relatorios.index', [

            'faturamentoTotal' => Venda::where('empresa_id', $empresaId)->sum('total'),
            'lucroTotal' => Venda::where('empresa_id', $empresaId)->sum('lucro_total'),

            'vendasHoje' => Venda::where('empresa_id', $empresaId)
                ->whereDate('created_at', today())
                ->count(),

            'vendasMes' => Venda::where('empresa_id', $empresaId)
                ->whereMonth('created_at', now()->month)
                ->count(),

            'produtos' => Produto::where('empresa_id', $empresaId)
                ->where('ativo', true)
                ->count(),

            'clientes' => Cliente::where('empresa_id', $empresaId)
                ->where('ativo', true)
                ->count(),

            'estoqueBaixo' => Produto::where('empresa_id', $empresaId)
                ->whereColumn('estoque', '<=', 'estoque_minimo')
                ->count(),

            'ultimasVendas' => Venda::with('cliente')
                ->where('empresa_id', $empresaId)
                ->latest()
                ->take(10)
                ->get(),

        ])->layout('layouts.app');
    }
}