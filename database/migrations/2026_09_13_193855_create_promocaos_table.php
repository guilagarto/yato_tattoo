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
    Schema::create('carrossels', function (Blueprint $table) {
        $table->id();
        $table->string('imagem'); // Caminho da foto do banner
        $table->string('titulo')->nullable(); // Texto opcional por cima da foto
        $table->string('link')->nullable(); // Link para onde o clique leva (ex: /agenda)
        $table->boolean('ativo')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocaos');
    }
};
