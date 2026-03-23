<?php

namespace App\Http\Controllers;

use App\Models\Transportadora;
use Illuminate\Http\Request;

class TransportadoraController extends Controller
{
    public function index()
    {
        $transportadoras = Transportadora::latest()->paginate(10);

        return view('transportadoras.index', compact('transportadoras'));
    }

    public function create()
    {
        return view('transportadoras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cnpj' => 'required|unique:transportadoras',
            'cep' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'rua' => 'required',
            'numero' => 'required'
        ]);

        Transportadora::create($request->all());

        return redirect()
            ->route('transportadoras.index')
            ->with('success', 'Transportadora criada com sucesso');
    }

    public function show(Transportadora $transportadora)
    {
        return view('transportadoras.show', compact('transportadora'));
    }

    public function edit(Transportadora $transportadora)
    {
        return view('transportadoras.edit', compact('transportadora'));
    }

    public function update(Request $request, Transportadora $transportadora)
    {
        $request->validate([
            'nome' => 'required',
            'cnpj' => 'required|unique:transportadoras,cnpj,' . $transportadora->id,
            'cep' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'rua' => 'required',
            'numero' => 'required'
        ]);

        $transportadora->update($request->all());

        return redirect()
            ->route('transportadoras.index')
            ->with('success', 'Transportadora atualizada');
    }

    public function destroy(Transportadora $transportadora)
    {
        $transportadora->delete();

        return redirect()
            ->route('transportadoras.index')
            ->with('success', 'Transportadora removida');
    }
}