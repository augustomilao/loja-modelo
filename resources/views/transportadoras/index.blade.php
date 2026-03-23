@extends('adminlte::page')

@section('title', 'Transportadoras')

@section('content_header')
    <h1>Transportadoras</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <div class="row mb-3">

            <div class="col-md-12 text-right">

                <a href="{{ route('transportadoras.create') }}"
                   class="btn btn-success">
                    Nova Transportadora
                </a>

            </div>

        </div>

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th width="220">Ações</th>
                </tr>
            </thead>

            <tbody>

                @forelse($transportadoras as $transportadora)

                    <tr>

                        <td>{{ $transportadora->id }}</td>

                        <td>{{ $transportadora->nome }}</td>

                        <td>{{ $transportadora->cnpj }}</td>

                        <td>{{ $transportadora->cidade }}</td>

                        <td>{{ $transportadora->estado }}</td>

                        <td>

                            <a href="{{ route('transportadoras.show', $transportadora->id) }}"
                               class="btn btn-info btn-sm">
                                Ver
                            </a>

                            <a href="{{ route('transportadoras.edit', $transportadora->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('transportadoras.destroy', $transportadora->id) }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Excluir transportadora?')">
                                    Excluir
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            Nenhuma transportadora cadastrada
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">
            {{ $transportadoras->links() }}
        </div>

    </div>

</div>

@stop