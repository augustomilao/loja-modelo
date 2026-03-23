<?php

namespace App\Http\Controllers\Api;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PedidoApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Pedido::with('itens')->get()
        );
    }

    public function show($id)
    {
        $pedido = Pedido::with('itens')->findOrFail($id);

        return response()->json($pedido);
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required',
            'nome_cliente' => 'required',
            'itens' => 'required|array',
            'itens.*.produto' => 'required',
            'itens.*.preco' => 'required',
            'itens.*.quantidade' => 'required'
        ]);

        $pedido = Pedido::create([
            'descricao' => $request->descricao,
            'nome_cliente' => $request->nome_cliente,
            'total' => 0
        ]);

        $total = 0;

        foreach ($request->itens as $item) {

            $subtotal = $item['preco'] * $item['quantidade'];

            $pedido->itens()->create([
                'produto' => $item['produto'],
                'preco' => $item['preco'],
                'quantidade' => $item['quantidade'],
                'total' => $subtotal
            ]);

            $total += $subtotal;
        }

        $pedido->update([
            'total' => $total
        ]);

        return response()->json($pedido, 201);
    }
}