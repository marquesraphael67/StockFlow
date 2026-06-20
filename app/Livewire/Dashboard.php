<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $empresaId = auth()->user()->empresa_id;

        $vendas7Dias = [];
        $faturamento7Dias = [];

        for ($i = 6; $i >= 0; $i--) {
            $data = now()->subDays($i);

            $vendas7Dias[] = [
                'dia' => $data->format('d/m'),
                'total' => Venda::where('empresa_id', $empresaId)
                    ->whereDate('created_at', $data)
                    ->count(),
            ];

            $faturamento7Dias[] = [
                'dia' => $data->format('d/m'),
                'total' => Venda::where('empresa_id', $empresaId)
                    ->whereDate('created_at', $data)
                    ->sum('total'),
            ];
        }

        return view('livewire.dashboard', [
            'faturamentoTotal' => Venda::where('empresa_id', $empresaId)->sum('total'),
            'lucroTotal' => Venda::where('empresa_id', $empresaId)->sum('lucro_total'),
            'vendasHoje' => Venda::where('empresa_id', $empresaId)->whereDate('created_at', today())->count(),
            'totalVendas' => Venda::where('empresa_id', $empresaId)->count(),
            'totalProdutos' => Produto::where('empresa_id', $empresaId)->where('ativo', true)->count(),
            'totalClientes' => Cliente::where('empresa_id', $empresaId)->where('ativo', true)->count(),
            'estoqueBaixo' => Produto::where('empresa_id', $empresaId)
                ->where('ativo', true)
                ->whereColumn('estoque', '<=', 'estoque_minimo')
                ->count(),
            'ultimasVendas' => Venda::with('cliente')
                ->where('empresa_id', $empresaId)
                ->latest()
                ->take(5)
                ->get(),
            'vendas7Dias' => $vendas7Dias,
            'faturamento7Dias' => $faturamento7Dias,
        ])->layout('layouts.app');
    }
}