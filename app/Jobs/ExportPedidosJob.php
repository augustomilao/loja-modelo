<?php

namespace App\Jobs;

use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\PedidoExport;

class ExportPedidosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $export;

    public function __construct(PedidoExport $export)
    {
        $this->export = $export;
    }

    public function handle()
    {
        $query = Pedido::query()->with('itens');

        if ($this->export->nome_cliente) {
            $query->where(
                'nome_cliente',
                'like',
                "%{$this->export->nome_cliente}%"
            );
        }

        $pedidos = $query->get();

        $csv = "ID,Cliente,Descricao,Produto,Preco,Quantidade,Total\n";

        foreach ($pedidos as $pedido) {

            foreach ($pedido->itens as $item) {

                $csv .= implode(',', [
                    $pedido->id,
                    $pedido->nome_cliente,
                    $pedido->descricao,
                    $item->produto,
                    $item->preco,
                    $item->quantidade,
                    $item->total
                ]) . "\n";
            }
        }

        Storage::put(
            "exports/{$this->export->file_name}",
            $csv
        );

        $this->export->update([
            'status' => 'completed'
        ]);
    }
}