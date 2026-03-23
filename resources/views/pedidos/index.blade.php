@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1>Pedidos</h1>
@stop

@section('content')

<a href="{{ route('pedidos.create') }}" class="btn btn-primary mb-3">
    Novo Pedido
</a>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th width="200">Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pedidos as $pedido)

                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->descricao }}</td>
                        <td>{{ $pedido->nome_cliente }}</td>
                        <td>R$ {{ $pedido->total }}</td>

                        <td>

                            <a href="{{ route('pedidos.show', $pedido->id) }}"
                               class="btn btn-info btn-sm">
                                Ver
                            </a>

                            <a href="{{ route('pedidos.edit', $pedido->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('pedidos.destroy', $pedido->id) }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Excluir
                                </button>

                            </form>

                        </td>
                    </tr>

                @endforeach
            </tbody>

        </table>

        {{ $pedidos->links() }}

    </div>
</div>

@stop