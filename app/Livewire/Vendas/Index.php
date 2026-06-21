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
    public $desconto = 0;
    public $carrinho = [];

    public function adicionarProduto()
    {
        $this->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::where('empresa_id', auth()->user()->empresa_id)
            ->where('ativo', true)
            ->findOrFail($this->produto_id);

        if ($produto->estoque < $this->quantidade) {
            session()->flash('erro', 'Estoque insuficiente.');
            return;
        }

        $this->carrinho[] = [
            'produto_id' => $produto->id,
            'nome' => $produto->nome,
            'quantidade' => $this->quantidade,
            'preco_unitario' => $produto->preco_venda,
            'preco_custo' => $produto->preco_custo,
            'subtotal' => $produto->preco_venda * $this->quantidade,
            'lucro' => ($produto->preco_venda - $produto->preco_custo) * $this->quantidade,
        ];

        $this->reset(['produto_id']);
        $this->quantidade = 1;
    }

    public function removerProduto($index)
    {
        unset($this->carrinho[$index]);
        $this->carrinho = array_values($this->carrinho);
    }

    public function getSubtotalProperty()
    {
        return collect($this->carrinho)->sum('subtotal');
    }

    public function getLucroTotalProperty()
    {
        return collect($this->carrinho)->sum('lucro');
    }

    public function getTotalProperty()
    {
        return max($this->subtotal - (float) $this->desconto, 0);
    }

    public function finalizarVenda()
    {
        if (count($this->carrinho) === 0) {
            session()->flash('erro', 'Adicione pelo menos um produto ao carrinho.');
            return;
        }

        foreach ($this->carrinho as $item) {
            $produto = Produto::where('empresa_id', auth()->user()->empresa_id)
                ->findOrFail($item['produto_id']);

            if ($produto->estoque < $item['quantidade']) {
                session()->flash('erro', 'Estoque insuficiente para o produto: ' . $produto->nome);
                return;
            }
        }

        $venda = Venda::create([
            'empresa_id' => auth()->user()->empresa_id,
            'cliente_id' => $this->cliente_id ?: null,
            'total' => $this->total,
            'lucro_total' => $this->lucroTotal,
            'status' => 'finalizada',
        ]);

        foreach ($this->carrinho as $item) {
            $produto = Produto::findOrFail($item['produto_id']);

            VendaItem::create([
                'venda_id' => $venda->id,
                'produto_id' => $produto->id,
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco_unitario'],
                'subtotal' => $item['subtotal'],
                'lucro' => $item['lucro'],
            ]);

            $produto->decrement('estoque', $item['quantidade']);

            Movimentacao::create([
                'empresa_id' => auth()->user()->empresa_id,
                'produto_id' => $produto->id,
                'tipo' => 'saida',
                'quantidade' => $item['quantidade'],
                'motivo' => 'Venda #' . $venda->id,
            ]);
        }

        $this->reset(['cliente_id', 'produto_id', 'carrinho', 'desconto']);
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