<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendaItem extends Model
{
    protected $table = 'venda_itens';

    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'subtotal',
        'lucro',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}