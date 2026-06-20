<?php

namespace App\Livewire\Clientes;

use App\Models\Cliente;
use Livewire\Component;

class Index extends Component
{
    public $cliente_id;
    public $nome;
    public $telefone;
    public $email;
    public $cpf_cnpj;
    public $mostrarArquivados = false;

    public function salvar()
    {
        $this->validate([
            'nome' => 'required|min:3',
            'telefone' => [
    'nullable',
    'regex:/^[0-9\(\)\-\s]+$/',
    'max:15'
],
            'email' => 'nullable|email',
            'cpf_cnpj' => [
    'nullable',
    'regex:/^[0-9\.\/\-]+$/',
    'max:18'
],
        ]);

        Cliente::updateOrCreate(
            ['id' => $this->cliente_id],
            [
                'empresa_id' => auth()->user()->empresa_id,
                'nome' => $this->nome,
                'telefone' => $this->telefone,
                'email' => $this->email,
                'cpf_cnpj' => $this->cpf_cnpj,
                'ativo' => true,
            ]
        );

        $this->limpar();

        session()->flash('success', 'Cliente salvo com sucesso!');
    }

    public function editar($id)
    {
        $cliente = Cliente::where('empresa_id', auth()->user()->empresa_id)
            ->findOrFail($id);

        $this->cliente_id = $cliente->id;
        $this->nome = $cliente->nome;
        $this->telefone = $cliente->telefone;
        $this->email = $cliente->email;
        $this->cpf_cnpj = $cliente->cpf_cnpj;
    }

    public function arquivar($id)
    {
        Cliente::where('empresa_id', auth()->user()->empresa_id)
            ->where('id', $id)
            ->update(['ativo' => false]);

        session()->flash('success', 'Cliente arquivado com sucesso!');
    }

    public function restaurar($id)
    {
        Cliente::where('empresa_id', auth()->user()->empresa_id)
            ->where('id', $id)
            ->update(['ativo' => true]);

        session()->flash('success', 'Cliente restaurado com sucesso!');
    }

    public function limpar()
    {
        $this->reset([
            'cliente_id',
            'nome',
            'telefone',
            'email',
            'cpf_cnpj',
        ]);
    }

    public function render()
    {
        return view('livewire.clientes.index', [
            'clientes' => Cliente::where('empresa_id', auth()->user()->empresa_id)
                ->where('ativo', !$this->mostrarArquivados)
                ->latest()
                ->get()
        ])->layout('layouts.app');
    }
}