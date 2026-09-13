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
    Schema::create('portfolios', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('imagem'); // Guardará o caminho do arquivo da foto
        $table->string('estilo')->nullable(); // Ex: Realismo, Old School, Fine Line
        $table->text('descricao')->nullable();
        $table->timestamps(); // Cria as colunas created_at e updated_at automaticamente
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
