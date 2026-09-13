<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrossel extends Model
{
   protected $fillable = ['imagem', 'titulo', 'link', 'ativo'];

}
