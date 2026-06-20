<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    public function run(): void
    {
        Empresa::create([
            'nome' => 'Empresa Teste',
            'email' => 'empresa@teste.com',
            'plano' => 'premium',
            'status' => 'trial',
            'trial_ends_at' => now()->addDays(7),
            'ativo' => true,
        ]);
    }
}