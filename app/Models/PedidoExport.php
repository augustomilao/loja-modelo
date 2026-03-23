<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoExport extends Model
{
    protected $fillable = [
        'file_name',
        'nome_cliente',
        'status'
    ];
}