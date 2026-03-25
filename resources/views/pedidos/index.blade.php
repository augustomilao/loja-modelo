@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1>Pedidos</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <form method="GET" action="{{ route('pedidos.index') }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Buscar por cliente</label>
                        <input type="text" name="nome_cliente" class="form-control"
                            placeholder="Digite o nome do cliente" value="{{ request('nome_cliente') }}">
                    </div>
                </div>

                <div class="col-md-2" style="margin-top:30px">
                    <button class="btn btn-primary">Buscar</button>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Limpar</a>
                </div>

                <div class="col-md-6 text-right" style="margin-top:30px">
                    <a href="{{ route('pedidos.export', request()->all()) }}" class="btn btn-info">Baixar Pedidos</a>
                    <a href="{{ route('pedidos.create') }}" class="btn btn-success">Novo Pedido</a>
                </div>
            </div>
        </form>

        <hr>

        <table class="table table-bordered table-striped">
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
                @forelse($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->descricao }}</td>
                        <td>{{ $pedido->nome_cliente }}</td>
                        <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Excluir pedido?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhum pedido encontrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $pedidos->links('pagination::simple-bootstrap-4') }}
        </div>

    </div>
</div>
@stop

@push('css')
<style>
    /* Remove ícones da paginação do AdminLTE */
    ul.pagination li a i,
    ul.pagination li span i {
        display: none !important;
        width: 0;
        height: 0;
    }

    /* Ajusta padding e tamanho da paginação */
    .pagination {
        font-size: 0.85rem;
    }
    .pagination li a,
    .pagination li span {
        padding: 0.25rem 0.5rem;
    }
</style>
@endpush