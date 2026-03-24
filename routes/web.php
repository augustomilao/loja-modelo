<?php

use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransportadoraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentationController;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // exportações
    Route::get(
        'pedidos/export',
        [PedidoController::class, 'export']
    )->name('pedidos.export');

    Route::get(
        'pedidos/downloads',
        [PedidoController::class, 'downloads']
    )->name('pedidos.downloads');

    Route::get(
        'pedidos/download/{id}',
        [PedidoController::class, 'download']
    )->name('pedidos.download');

    Route::get('docs', [DocumentationController::class , 'index'])->name('docs');


    // resource sempre por último
    Route::resource('pedidos', PedidoController::class);
    Route::resource('transportadoras', TransportadoraController::class);
});



require __DIR__ . '/auth.php';
