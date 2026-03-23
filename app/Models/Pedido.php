<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'descricao',
        'nome_cliente',
        'total'
    ];

    public function itens()
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function recalcularTotal()
    {
        $this->total = $this->itens()->sum('total');
        $this->save();
    }
}