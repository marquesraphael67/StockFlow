<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'empresa_id',
        'nome',
        'telefone',
        'email',
        'cpf_cnpj',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];
}