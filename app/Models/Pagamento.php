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
}