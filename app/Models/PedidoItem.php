<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'pedido_itens';
    protected $fillable = [
        'pedido_id',
        'produto',
        'preco',
        'quantidade',
        'total'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            $item->total = $item->preco * $item->quantidade;
        });
    }
}