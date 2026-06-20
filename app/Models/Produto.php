<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    protected $fillable = [
        'empresa_id',
        'categoria_id',
        'nome',
        'sku',
        'preco_custo',
        'preco_venda',
        'estoque',
        'estoque_minimo',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'preco_custo' => 'decimal:2',
        'preco_venda' => 'decimal:2',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}