<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    protected $fillable = [
        'empresa_id',
        'plano',
        'valor',
        'status',
        'data_inicio',
        'data_expiracao',
    ];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_expiracao' => 'datetime',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}