<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = ['ano_lancamento', 'marca', 'descricao', 'tipo_veiculo', 'imagem'];
}
