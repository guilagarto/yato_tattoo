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
    Schema::create('promocaos', function (Blueprint $table) {
        $table->id();
        $table->string('titulo'); // Ex: "Semana da Black Tattoo"
        $table->text('descricao'); // Ex: "Ganhe 20% de desconto em artes autorais"
        $table->string('cupom')->nullable(); // Ex: "YATO20"
        $table->boolean('ativa')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrossels');
    }
};
