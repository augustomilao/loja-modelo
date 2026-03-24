<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $totais = Cache::remember('dashboard_totais', now()->addMinutes(10), function () {
            $totais = Pedido::selectRaw('COUNT(*) as total_pedidos, SUM(total) as total_vendido')->first();

            // garantir que só dados primitivos serão armazenados
            return [
                'totalPedidos' => $totais->total_pedidos,
                'totalVendido' => $totais->total_vendido,
            ];
        });

        // agora $totais é um array simples, sem objeto Eloquent
        $totalPedidos = $totais['totalPedidos'];
        $totalVendido = $totais['totalVendido'];
        //TODO: Explicar aqui
        // CREATE INDEX idx_pedidos_total ON pedidos(total);
        //* Cliente pode reclamar

        return view('dashboard', compact(
            'totalPedidos',
            'totalVendido'
        ));
    }
}
