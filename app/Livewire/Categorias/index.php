<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use Livewire\Component;

class Index extends Component
{
    public $nome = '';

    public function salvar()
    {
        $this->validate([
            'nome' => 'required|min:2'
        ]);

        Categoria::create([
            'empresa_id' => auth()->user()->empresa_id,
            'nome' => $this->nome,
            'ativo' => true
        ]);

        $this->reset('nome');

        session()->flash('success', 'Categoria criada com sucesso!');
    }

    public function render()
    {
        return view('livewire.categorias.index', [
            'categorias' => Categoria::where('empresa_id', auth()->user()->empresa_id)
                ->where('ativo', true)
                ->latest()
                ->get()
        ])->layout('layouts.app');
    }
}