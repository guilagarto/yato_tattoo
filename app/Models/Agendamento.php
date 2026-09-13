<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'cliente_nome', 
        'cliente_whatsapp', 
        'data', 
        'hora', 
        'tatuador_nome', 
        'status', 
        'observacoes'
    ];
}
