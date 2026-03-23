<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePedidoRequest;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class PedidoApiController extends Controller
{
    public function index()
    {
        return Pedido::with('itens')->get();
    }

    public function show($id)
    {
        return Pedido::with('itens')->findOrFail($id);
    }

    public function store(StorePedidoRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $pedido = Pedido::create([
                'descricao' => $request->descricao,
                'nome_cliente' => $request->nome_cliente,
                'total' => 0
            ]);

            $totalPedido = 0;

            foreach ($request->itens as $item) {

                $totalItem = $item['preco'] * $item['quantidade'];

                $pedido->itens()->create([
                    'produto' => $item['produto'],
                    'preco' => $item['preco'],
                    'quantidade' => $item['quantidade'],
                    'total' => $totalItem
                ]);

                $totalPedido += $totalItem;
            }

            $pedido->update([
                'total' => $totalPedido
            ]);

            return response()->json([
                'message' => 'Pedido criado com sucesso',
                'data' => $pedido->load('itens')
            ], 201);
        });
    }
}