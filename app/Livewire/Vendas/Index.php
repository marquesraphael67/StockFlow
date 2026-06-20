<?php

namespace App\Livewire\Vendas;

use App\Models\Cliente;
use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaItem;
use Livewire\Component;

class Index extends Component
{
    public $cliente_id;
    public $produto_id;
    public $quantidade = 1;

    public function finalizarVenda()
    {
        $this->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::where('empresa_id', auth()->user()->empresa_id)
            ->where('ativo', true)
            ->findOrFail($this->produto_id);

        if ($produto->estoque < $this->quantidade) {
            session()->flash('erro', 'Estoque insuficiente para realizar a venda.');
            return;
        }

        $subtotal = $produto->preco_venda * $this->quantidade;
        $lucro = ($produto->preco_venda - $produto->preco_custo) * $this->quantidade;

        $venda = Venda::create([
    'empresa_id' => auth()->user()->empresa_id,
    'cliente_id' => $this->cliente_id ?: null,
    'total' => $subtotal,
    'lucro_total' => $lucro,
    'status' => 'finalizada',
]);

        VendaItem::create([
    'venda_id' => $venda->id,
    'produto_id' => $produto->id,
    'quantidade' => $this->quantidade,
    'preco_unitario' => $produto->preco_venda,
    'subtotal' => $subtotal,
    'lucro' => $lucro,
]);

        $produto->decrement('estoque', $this->quantidade);

        Movimentacao::create([
            'empresa_id' => auth()->user()->empresa_id,
            'produto_id' => $produto->id,
            'tipo' => 'saida',
            'quantidade' => $this->quantidade,
            'motivo' => 'Venda #' . $venda->id,
        ]);

        $this->reset(['cliente_id', 'produto_id']);
        $this->quantidade = 1;

        session()->flash('success', 'Venda finalizada com sucesso!');
    }

    public function render()
    {
        return view('livewire.vendas.index', [
            'clientes' => Cliente::where('empresa_id', auth()->user()->empresa_id)
                ->where('ativo', true)
                ->orderBy('nome')
                ->get(),

            'produtos' => Produto::where('empresa_id', auth()->user()->empresa_id)
                ->where('ativo', true)
                ->where('estoque', '>', 0)
                ->orderBy('nome')
                ->get(),

            'vendas' => Venda::with(['cliente', 'itens.produto'])
                ->where('empresa_id', auth()->user()->empresa_id)
                ->latest()
                ->get(),
        ])->layout('layouts.app');
    }
}