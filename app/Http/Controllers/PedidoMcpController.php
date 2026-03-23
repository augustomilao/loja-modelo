<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoMcpController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_pedidos' => Pedido::count(),
            'total_vendido' => Pedido::sum('total'),
            'pedidos' => Pedido::with('itens')
                ->latest()
                ->limit(20)
                ->get()
        ]);
    }

    public function show($id)
    {
        $pedido = Pedido::with('itens')->findOrFail($id);

        return response()->json($pedido);
    }

    public function search(Request $request)
    {
        $pedidos = Pedido::with('itens')
            ->when($request->nome_cliente, function ($q) use ($request) {
                $q->where('nome_cliente', 'like', '%' . $request->nome_cliente . '%');
            })
            ->get();

        return response()->json($pedidos);
    }
}