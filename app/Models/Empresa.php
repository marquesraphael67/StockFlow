<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\WithFileUploads;

class Empresa extends Model
{
    protected $fillable = [
    'nome',
    'email',
    'telefone',
    'cpf_cnpj',
    'cep',
    'endereco',
    'numero',
    'bairro',
    'cidade',
    'estado',
    'plano',
    'status',
    'trial_ends_at',
    'ativo',
    'logo',
];

    protected $casts = [
        'trial_ends_at' => 'datetime',
        'ativo' => 'boolean'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}