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
    Schema::create('assinaturas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();

        $table->string('plano');
        $table->decimal('valor', 10, 2);
        $table->string('status')->default('trial');

        $table->timestamp('data_inicio')->nullable();
        $table->timestamp('data_expiracao')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assinaturas');
    }
};
