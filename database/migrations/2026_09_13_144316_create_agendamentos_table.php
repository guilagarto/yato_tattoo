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
    Schema::create('agendamentos', function (Blueprint $table) {
        $table->id();
        $table->string('cliente_nome');
        $table->string('cliente_whatsapp');
        $table->date('data');
        $table->time('hora');
        $table->string('tatuador_nome')->default('Yato'); // Caso tenha mais tatuadores no futuro
        $table->string('status')->default('Pendente'); // Pendente, Confirmado, Concluído, Cancelado
        $table->text('observacoes')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
