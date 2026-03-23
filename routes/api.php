<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PedidoApiController;
use App\Http\Controllers\PedidoMcpController;

Route::get('pedidos', [PedidoApiController::class, 'index']);
Route::get('pedidos/{id}', [PedidoApiController::class, 'show']);
Route::post('pedidos', [PedidoApiController::class, 'store']);

Route::prefix('mcp')->group(function () {

    Route::get('pedidos', [PedidoMcpController::class, 'index']);
    Route::get('pedidos/{id}', [PedidoMcpController::class, 'show']);
    Route::get('search', [PedidoMcpController::class, 'search']);
});
