<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'empresa_id',
        'cliente_id',
        'total',
        'status',
        'lucro_total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function itens()
    {
        return $this->hasMany(VendaItem::class);
    }
}