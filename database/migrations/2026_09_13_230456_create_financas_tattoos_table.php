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
    Schema::create('financas_tattoos', function (Blueprint $table) {
        $table->id();
        $table->string('descricao'); // Ex: "Tatuagem Fechamento de Braço" ou "Compra de Tintas"
        $table->string('tipo'); // 'receita' (entrada) ou 'custo' (saída)
        $table->decimal('valor', 10, 2); // Salva valores decimais perfeitamente (ex: 1500.50)
        $table->date('data_movimentacao'); // Data em que o dinheiro entrou ou saiu
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financas_tattoos');
    }
};
