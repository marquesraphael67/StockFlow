<?php

namespace App\Livewire\Auth;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterEmpresa extends Component
{
    public $empresa_nome;
    public $responsavel_nome;
    public $email;
    public $password;
    public $password_confirmation;
    public $plano = 'basico';

    public function mount()
    {
        if (request()->has('plano')) {
            $this->plano = request('plano');
        }
    }

    public function cadastrar()
    {
        $this->validate([
            'empresa_nome' => 'required|min:3',
            'responsavel_nome' => 'required|min:3',
            'email' => 'required|email|unique:users,email|unique:empresas,email',
            'password' => 'required|min:8|confirmed',
            'plano' => 'required|in:basico,pro,premium',
        ]);

        $empresa = Empresa::create([
            'nome' => $this->empresa_nome,
            'email' => $this->email,
            'plano' => 'basico',
            'status' => 'trial',
            'trial_ends_at' => now()->addDays(7),
            'ativo' => true,
        ]);

        $user = User::create([
            'empresa_id' => $empresa->id,
            'name' => $this->responsavel_nome,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register-empresa')
            ->layout('layouts.auth-bootstrap');
    }
}
