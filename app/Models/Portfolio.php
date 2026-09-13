<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    // ADICIONE ESTA LINHA EXATAMENTE AQUI:
    protected $fillable = ['titulo', 'imagem', 'estilo', 'descricao'];
}
