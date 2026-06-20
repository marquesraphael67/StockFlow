<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Produto;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioPdfController extends Controller
{
    public function vendas()
    {
        $empresa = auth()->user()->empresa;
        $empresaId = auth()->user()->empresa_id;

        $vendas = Venda::with(['cliente', 'itens.produto'])
            ->where('empresa_id', $empresaId)
            ->latest()
            ->get();

        $dados = [
            'empresa' => $empresa,
            'usuario' => auth()->user(),
            'vendas' => $vendas,
            'faturamentoTotal' => Venda::where('empresa_id', $empresaId)->sum('total'),
            'lucroTotal' => Venda::where('empresa_id', $empresaId)->sum('lucro_total'),
            'totalVendas' => Venda::where('empresa_id', $empresaId)->count(),
            'totalClientes' => Cliente::where('empresa_id', $empresaId)->where('ativo', true)->count(),
            'totalProdutos' => Produto::where('empresa_id', $empresaId)->where('ativo', true)->count(),
            'estoqueBaixo' => Produto::where('empresa_id', $empresaId)
                ->whereColumn('estoque', '<=', 'estoque_minimo')
                ->where('ativo', true)
                ->get(),
            'dataGeracao' => now()->format('d/m/Y H:i'),
        ];

        $pdf = Pdf::loadView('pdf.relatorios.vendas', $dados)
            ->setPaper('a4', 'portrait');

        return $pdf->download('relatorio-stockflow.pdf');
    }
}