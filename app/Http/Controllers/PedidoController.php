<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PedidoExport;
use App\Jobs\ExportPedidosJob;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $pedidos = Pedido::query()
            ->when($request->nome_cliente, function ($query, $nome) {
                $query->where('nome_cliente', 'like', "%{$nome}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        return view('pedidos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'nome_cliente' => 'required|string|max:255',

            'produto.*' => 'required|string',
            'preco.*' => 'required|numeric|min:0',
            'quantidade.*' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();

        try {

            $pedido = Pedido::create([
                'descricao' => $data['descricao'],
                'nome_cliente' => $data['nome_cliente'],
                'total' => 0
            ]);

            foreach ($request->produto as $i => $produto) {

                PedidoItem::create([
                    'pedido_id' => $pedido->id,
                    'produto' => $produto,
                    'preco' => $request->preco[$i],
                    'quantidade' => $request->quantidade[$i]
                ]);
            }

            $pedido->recalcularTotal();

            DB::commit();

            return redirect()
                ->route('pedidos.index')
                ->with('success', 'Pedido criado com sucesso');
        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;
        }
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('itens');

        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        $pedido->load('itens');
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'nome_cliente' => 'required|string|max:255',
            'produto.*' => 'required|string',
            'preco.*' => 'required|numeric|min:0',
            'quantidade.*' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request, $pedido, $data) {

            $pedido->update([
                'descricao' => $data['descricao'],
                'nome_cliente' => $data['nome_cliente']
            ]);

            $pedido->itens()->delete();

            foreach ($request->produto as $i => $produto) {

                PedidoItem::create([
                    'pedido_id' => $pedido->id,
                    'produto' => $produto,
                    'preco' => $request->preco[$i],
                    'quantidade' => $request->quantidade[$i]
                ]);
            }

            $pedido->recalcularTotal();
        });

        return redirect()->route('pedidos.index');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedidos.index');
    }

    public function export(Request $request)
    {
        $export = PedidoExport::create([
            'file_name' => 'pedidos_' . now()->timestamp . '.csv',
            'nome_cliente' => $request->nome_cliente,
            'status' => 'processing'
        ]);

        ExportPedidosJob::dispatch($export);

        return redirect()
            ->route('pedidos.downloads')
            ->with('success', 'Exportação iniciada.');
    }

    public function downloads()
    {
        $exports = PedidoExport::latest()->get();

        return view('pedidos.downloads', compact('exports'));
    }

    public function download($id)
    {
        $export = PedidoExport::findOrFail($id);

        $path = "exports/{$export->file_name}";

        if (!Storage::exists($path)) {
            return redirect()
                ->back()
                ->with('error', 'Arquivo não encontrado.');
        }

        return Storage::download($path);
    }
}
