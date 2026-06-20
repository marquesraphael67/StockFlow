<?php

namespace App\Livewire\Movimentacoes;

use App\Models\Movimentacao;
use App\Models\Produto;
use Livewire\Component;

class Index extends Component
{
    public $produto_id;
    public $tipo = 'entrada';
    public $quantidade = 1;
    public $motivo;

    public function salvar()
    {
        $this->validate([
            'produto_id' => 'required|exists:produtos,id',
            'tipo' => 'required|in:entrada,saida',
            'quantidade' => 'required|integer|min:1',
            'motivo' => 'nullable|string|max:255',
        ]);

        $produto = Produto::where('empresa_id', auth()->user()->empresa_id)
            ->where('id', $this->produto_id)
            ->firstOrFail();

        if ($this->tipo === 'saida' && $produto->estoque < $this->quantidade) {
            session()->flash('erro', 'Estoque insuficiente para essa saída.');
            return;
        }

        if ($this->tipo === 'entrada') {
            $produto->increment('estoque', $this->quantidade);
        } else {
            $produto->decrement('estoque', $this->quantidade);
        }

        Movimentacao::create([
            'empresa_id' => auth()->user()->empresa_id,
            'produto_id' => $produto->id,
            'tipo' => $this->tipo,
            'quantidade' => $this->quantidade,
            'motivo' => $this->motivo,
        ]);

        $this->reset(['produto_id', 'motivo']);
        $this->tipo = 'entrada';
        $this->quantidade = 1;

        session()->flash('success', 'Movimentação registrada com sucesso!');
    }

    public function render()
    {
        return view('livewire.movimentacoes.index', [
            'produtos' => Produto::where('empresa_id', auth()->user()->empresa_id)
                ->where('ativo', true)
                ->orderBy('nome')
                ->get(),

            'movimentacoes' => Movimentacao::with('produto')
                ->where('empresa_id', auth()->user()->empresa_id)
                ->latest()
                ->get()
        ])->layout('layouts.app');
    }
}