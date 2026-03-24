<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\PedidoItem;

class PedidoSeeder extends Seeder
{
    public function run()
    {

        //TODO: Explicar tbm o pq eu criei o index no banco CREATE INDEX idx_pedido_itens_pedido_id ON pedido_itens(pedido_id);

        $totalPedidos = 1000000;
        $itensPorPedido = 5;
        $chunkSize = 1000; // insere 1000 pedidos por vez

        for ($i = 0; $i < $totalPedidos; $i += $chunkSize) {
            $pedidos = [];
            $itens = [];

            for ($j = 0; $j < $chunkSize; $j++) {
                $pedidoId = $i + $j + 1;
                $pedidos[] = [
                    'descricao' => "Pedido $pedidoId",
                    'nome_cliente' => "Cliente $pedidoId",
                    'total' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                for ($k = 1; $k <= $itensPorPedido; $k++) {
                    $preco = rand(10, 100);
                    $quantidade = rand(1, 5);
                    $itens[] = [
                        'pedido_id' => $pedidoId,
                        'produto' => "Item $k",
                        'preco' => $preco,
                        'quantidade' => $quantidade,
                        'total' => $preco * $quantidade,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            Pedido::insert($pedidos);  // insere os pedidos
            PedidoItem::insert($itens); // insere os itens
        }
    }
}
