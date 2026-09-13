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
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('slug')->unique(); // Ex: 'cuidados-pos-tattoo' para a URL amigável
        $table->text('conteudo'); // O texto do artigo em si
        $table->string('capa')->nullable(); // Foto de destaque do post
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
