<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    protected $fillable = ['titulo', 'descricao', 'cupom', 'ativa'];

}
