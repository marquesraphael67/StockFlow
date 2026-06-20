<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('empresas', function (Blueprint $table) {
        $table->string('telefone')->nullable()->after('email');
        $table->string('cpf_cnpj')->nullable()->after('telefone');
        $table->string('cep')->nullable()->after('cpf_cnpj');
        $table->string('endereco')->nullable()->after('cep');
        $table->string('numero')->nullable()->after('endereco');
        $table->string('bairro')->nullable()->after('numero');
        $table->string('cidade')->nullable()->after('bairro');
        $table->string('estado')->nullable()->after('cidade');
    });
}

public function down(): void
{
    Schema::table('empresas', function (Blueprint $table) {
        $table->dropColumn([
            'telefone',
            'cpf_cnpj',
            'cep',
            'endereco',
            'numero',
            'bairro',
            'cidade',
            'estado',
        ]);
    });
}
};
