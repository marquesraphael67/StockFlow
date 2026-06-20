<?php

namespace App\Livewire\Produtos;

use App\Models\Categoria;
use App\Models\Produto;
use Livewire\Component;

class Index extends Component
{
    public $produto_id;
    public $categoria_id;
    public $nome;
    public $sku;
    public $preco_custo = 0;
    public $preco_venda = 0;
    public $estoque = 0;
    public $estoque_minimo = 0;
    public $mostrarArquivados = false;
    public $busca = '';
public $filtro_categoria = '';

    public function salvar()
    {
        $this->validate([
            'nome' => 'required|min:2',
            'preco_custo' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
            'estoque_minimo' => 'required|integer|min:0',
        ]);

        Produto::updateOrCreate(
            ['id' => $this->produto_id],
            [
                'empresa_id' => auth()->user()->empresa_id,
                'categoria_id' => $this->categoria_id ?: null,
                'nome' => $this->nome,
                'sku' => $this->sku,
                'preco_custo' => $this->preco_custo,
                'preco_venda' => $this->preco_venda,
                'estoque' => $this->estoque,
                'estoque_minimo' => $this->estoque_minimo,
                'ativo' => true,
            ]
        );

        $this->limpar();

        session()->flash('success', 'Produto salvo com sucesso!');
    }

    public function editar($id)
    {
        $produto = Produto::where('empresa_id', auth()->user()->empresa_id)->findOrFail($id);

        $this->produto_id = $produto->id;
        $this->categoria_id = $produto->categoria_id;
        $this->nome = $produto->nome;
        $this->sku = $produto->sku;
        $this->preco_custo = $produto->preco_custo;
        $this->preco_venda = $produto->preco_venda;
        $this->estoque = $produto->estoque;
        $this->estoque_minimo = $produto->estoque_minimo;
    }

    public function arquivar($id)
    {
        Produto::where('empresa_id', auth()->user()->empresa_id)
            ->where('id', $id)
            ->update(['ativo' => false]);

        session()->flash('success', 'Produto arquivado com sucesso!');
    }

    public function restaurar($id)
    {
        Produto::where('empresa_id', auth()->user()->empresa_id)
            ->where('id', $id)
            ->update(['ativo' => true]);

        session()->flash('success', 'Produto restaurado com sucesso!');
    }

    public function limpar()
    {
        $this->reset([
            'produto_id',
            'categoria_id',
            'nome',
            'sku',
            'preco_custo',
            'preco_venda',
            'estoque',
            'estoque_minimo',
        ]);

        $this->preco_custo = 0;
        $this->preco_venda = 0;
        $this->estoque = 0;
        $this->estoque_minimo = 0;
    }

    public function render()
    {
        return view('livewire.produtos.index', [
            'produtos' => Produto::with('categoria')
    ->where('empresa_id', auth()->user()->empresa_id)
    ->where('ativo', !$this->mostrarArquivados)
    ->when($this->busca, function ($query) {
        $query->where(function ($q) {
            $q->where('nome', 'like', '%' . $this->busca . '%')
              ->orWhere('sku', 'like', '%' . $this->busca . '%');
        });
    })
    ->when($this->filtro_categoria, function ($query) {
        $query->where('categoria_id', $this->filtro_categoria);
    })
    ->latest()
    ->get(),

            'categorias' => Categoria::where('empresa_id', auth()->user()->empresa_id)
                ->where('ativo', true)
                ->get()
        ])->layout('layouts.app');
    }
}