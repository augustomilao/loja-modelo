@extends('adminlte::page')

@section('title', 'Detalhes do Pedido')

@section('content_header')
    <h1>Pedido #{{ $pedido->id }}</h1>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informações do Pedido</h3>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">
                        <strong>ID</strong>
                        <p>{{ $pedido->id }}</p>
                    </div>

                    <div class="col-md-4">
                        <strong>Cliente</strong>
                        <p>{{ $pedido->nome_cliente }}</p>
                    </div>

                    <div class="col-md-4">
                        <strong>Descrição</strong>
                        <p>{{ $pedido->descricao }}</p>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <strong>Total do Pedido</strong>
                        <p>
                            <span class="badge badge-success" style="font-size:16px;">
                                R$ {{ number_format($pedido->total, 2, ',', '.') }}
                            </span>
                        </p>
                    </div>

                    <div class="col-md-4">
                        <strong>Criado em</strong>
                        <p>{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="col-md-4">
                        <strong>Atualizado em</strong>
                        <p>{{ $pedido->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>


<div class="row">

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Itens do Pedido</h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th width="150">Preço</th>
                            <th width="150">Quantidade</th>
                            <th width="150">Total</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pedido->itens as $item)

                            <tr>
                                <td>{{ $item->id }}</td>

                                <td>{{ $item->produto }}</td>

                                <td>
                                    R$ {{ number_format($item->preco, 2, ',', '.') }}
                                </td>

                                <td>
                                    {{ $item->quantidade }}
                                </td>

                                <td>
                                    <strong>
                                        R$ {{ number_format($item->total, 2, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center">
                                    Nenhum item encontrado
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card-footer">

                <a href="{{ route('pedidos.index') }}"
                   class="btn btn-secondary">
                    Voltar
                </a>

                <a href="{{ route('pedidos.edit', $pedido->id) }}"
                   class="btn btn-warning">
                    Editar Pedido
                </a>

                <form action="{{ route('pedidos.destroy', $pedido->id) }}"
                      method="POST"
                      style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger"
                            onclick="return confirm('Deseja excluir este pedido?')">
                        Excluir
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@stop