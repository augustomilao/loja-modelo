<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportadora extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'rua',
        'numero',
        'complemento'
    ];
}