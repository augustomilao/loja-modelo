<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PedidoApiController;

Route::get('pedidos', [PedidoApiController::class, 'index']);
Route::get('pedidos/{id}', [PedidoApiController::class, 'show']);
Route::post('pedidos', [PedidoApiController::class, 'store']);