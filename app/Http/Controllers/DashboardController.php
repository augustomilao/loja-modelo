<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPedidos = Pedido::count();

        $totalVendido = Pedido::sum('total');

        return view('dashboard', compact(
            'totalPedidos',
            'totalVendido'
        ));
    }
}