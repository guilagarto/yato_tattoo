<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VagaAgenda extends Model
{
    protected $fillable = ['data', 'hora', 'status', 'cliente_nome', 'cliente_whatsapp', 'observacoes'];

}
