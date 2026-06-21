<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaItem;
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

        $faturamentoTotal = Venda::where('empresa_id', $empresaId)->sum('total');
        $lucroTotal = Venda::where('empresa_id', $empresaId)->sum('lucro_total');
        $totalVendas = Venda::where('empresa_id', $empresaId)->count();

        return view('livewire.dashboard', [
            'faturamentoTotal' => $faturamentoTotal,
            'lucroTotal' => $lucroTotal,
            'ticketMedio' => $totalVendas > 0 ? $faturamentoTotal / $totalVendas : 0,
            'vendasHoje' => Venda::where('empresa_id', $empresaId)->whereDate('created_at', today())->count(),
            'totalVendas' => $totalVendas,
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

            'topProdutos' => VendaItem::selectRaw('produto_id, SUM(quantidade) as total_vendido')
                ->whereHas('produto', function ($query) use ($empresaId) {
                    $query->where('empresa_id', $empresaId);
                })
                ->with('produto')
                ->groupBy('produto_id')
                ->orderByDesc('total_vendido')
                ->take(5)
                ->get(),

            'topClientes' => Venda::selectRaw('cliente_id, COUNT(*) as total_compras, SUM(total) as total_gasto')
                ->where('empresa_id', $empresaId)
                ->whereNotNull('cliente_id')
                ->with('cliente')
                ->groupBy('cliente_id')
                ->orderByDesc('total_gasto')
                ->take(5)
                ->get(),

            'vendas7Dias' => $vendas7Dias,
            'faturamento7Dias' => $faturamento7Dias,
        ])->layout('layouts.app');
    }
}