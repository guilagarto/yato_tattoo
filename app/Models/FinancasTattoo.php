<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancasTattoo extends Model
{
    protected $fillable = ['descricao', 'tipo', 'valor', 'data_movimentacao'];

}
