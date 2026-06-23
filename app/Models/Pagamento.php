<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = [
        'empresa_id',
        'plano',
        'valor',
        'mercado_pago_id',
        'status',
        'qr_code',
        'qr_code_base64',
    ];

    public function ativarAssinatura()
{
    if ($this->status !== 'approved') {
        return;
    }

    \App\Models\Assinatura::updateOrCreate(
        ['empresa_id' => $this->empresa_id],
        [
            'plano' => $this->plano,
            'valor' => $this->valor,
            'status' => 'ativo',
            'data_inicio' => now(),
            'data_expiracao' => now()->addMonth(),
        ]
    );

    $this->empresa->update([
        'plano' => $this->plano,
        'status' => 'ativo',
        'trial_ends_at' => null,
        'ativo' => true,
    ]);
}



    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    
}