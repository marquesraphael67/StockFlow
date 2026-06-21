<?php

namespace App\Livewire\Configuracoes;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $empresa_nome;
    public $empresa_email;
    public $telefone;
    public $cpf_cnpj;
    public $cep;
    public $endereco;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $logo;

    public $user_name;
    public $user_email;

    public $current_password_email;

    public $current_password;
    public $password;
    public $password_confirmation;

    public $delete_password;
    public $delete_confirmation;

    public function mount()
    {
        $empresa = auth()->user()->empresa;
        $user = auth()->user();

        $this->empresa_nome = $empresa->nome;
        $this->empresa_email = $empresa->email;
        $this->telefone = $empresa->telefone;
        $this->cpf_cnpj = $empresa->cpf_cnpj;
        $this->cep = $empresa->cep;
        $this->endereco = $empresa->endereco;
        $this->numero = $empresa->numero;
        $this->bairro = $empresa->bairro;
        $this->cidade = $empresa->cidade;
        $this->estado = $empresa->estado;

        $this->user_name = $user->name;
        $this->user_email = $user->email;
    }

    public function salvarEmpresa()
    {
        $this->validate([
            'empresa_nome' => 'required|min:3',
            'empresa_email' => 'required|email',
            'telefone' => 'nullable|max:15',
            'cpf_cnpj' => 'nullable|max:18',
            'cep' => 'nullable|max:9',
            'estado' => 'nullable|max:2',
            'logo' => 'nullable|image|max:2048',
        ]);

        $empresa = auth()->user()->empresa;

        $logoPath = $empresa->logo;

        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public');
        }

        $empresa->update([
            'nome' => $this->empresa_nome,
            'email' => $this->empresa_email,
            'telefone' => $this->telefone,
            'cpf_cnpj' => $this->cpf_cnpj,
            'cep' => $this->cep,
            'endereco' => $this->endereco,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'logo' => $logoPath,
        ]);

        session()->flash('success', 'Dados da empresa atualizados!');
    }

    public function salvarPerfil()
    {
        $user = auth()->user();

        $rules = [
            'user_name' => 'required|min:3',
            'user_email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ];

        if ($this->user_email !== $user->email) {
            $rules['current_password_email'] = 'required|current_password';
        }

        $this->validate($rules);

        $user->update([
            'name' => $this->user_name,
            'email' => $this->user_email,
        ]);

        $this->reset('current_password_email');

        session()->flash('success', 'Perfil atualizado com sucesso!');
    }

    public function alterarSenha()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed|different:current_password',
        ]);

        auth()->user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset([
            'current_password',
            'password',
            'password_confirmation',
        ]);

        session()->flash('success', 'Senha alterada com segurança!');
    }

    public function excluirConta()
    {
        $this->validate([
            'delete_password' => 'required|current_password',
            'delete_confirmation' => 'required|in:EXCLUIR',
        ], [
            'delete_confirmation.in' => 'Digite exatamente EXCLUIR para confirmar.',
        ]);

        $empresa = auth()->user()->empresa;

        Auth::logout();

        $empresa->delete();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.configuracoes.index')->layout('layouts.app');
    }
}