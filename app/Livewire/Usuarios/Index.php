<?php

namespace App\Livewire\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $email;
    public $password;
    public $tipo = 'funcionario';

    public function salvar()
    {
        $empresa = auth()->user()->empresa;

        $totalUsuarios = User::where('empresa_id', $empresa->id)->count();

        if ($empresa->plano === 'basico' && $totalUsuarios >= 1) {
            session()->flash('erro', 'O plano Básico permite apenas 1 usuário.');
            return;
        }

        if ($empresa->plano === 'pro' && $totalUsuarios >= 5) {
            session()->flash('erro', 'O plano Pro permite até 5 usuários.');
            return;
        }

        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'tipo' => 'required|in:admin,funcionario',
        ]);

        User::create([
            'empresa_id' => $empresa->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'tipo' => $this->tipo,
        ]);

        $this->reset(['name', 'email', 'password']);
        $this->tipo = 'funcionario';

        session()->flash('success', 'Usuário criado com sucesso!');
    }

    public function arquivar($id)
    {
        if ($id == auth()->id()) {
            session()->flash('erro', 'Você não pode remover sua própria conta.');
            return;
        }

        User::where('empresa_id', auth()->user()->empresa_id)
            ->where('id', $id)
            ->delete();

        session()->flash('success', 'Usuário removido com sucesso!');
    }

    public function render()
    {
        return view('livewire.usuarios.index', [
            'usuarios' => User::where('empresa_id', auth()->user()->empresa_id)
                ->latest()
                ->get()
        ])->layout('layouts.app');
    }
}