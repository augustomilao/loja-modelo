@extends('adminlte::page')

@section('title', 'Novo Pedido')

@section('content_header')
    <h1>Novo Pedido</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Descrição</label>
                        <input
                            type="text"
                            name="descricao"
                            class="form-control"
                            placeholder="Descrição do pedido"
                            required
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nome do Cliente</label>
                        <input
                            type="text"
                            name="nome_cliente"
                            class="form-control"
                            placeholder="Nome do cliente"
                            required
                        >
                    </div>
                </div>

            </div>

            <hr>

            <h4>Itens do Pedido</h4>

            <table class="table table-bordered" id="tabela-itens">

                <thead>
                    <tr>
                        <th>Produto</th>
                        <th width="150">Preço</th>
                        <th width="150">Quantidade</th>
                        <th width="150">Total</th>
                        <th width="120">Ação</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>

                        <td>
                            <input
                                type="text"
                                name="produto[]"
                                class="form-control"
                                required
                            >
                        </td>

                        <td>
                            <input
                                type="number"
                                step="0.01"
                                name="preco[]"
                                class="form-control preco"
                                required
                            >
                        </td>

                        <td>
                            <input
                                type="number"
                                name="quantidade[]"
                                class="form-control quantidade"
                                required
                            >
                        </td>

                        <td>
                            <input
                                type="text"
                                class="form-control total-item"
                                readonly
                            >
                        </td>

                        <td>
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                onclick="removerLinha(this)"
                            >
                                Remover
                            </button>
                        </td>

                    </tr>

                </tbody>

            </table>

            <button
                type="button"
                class="btn btn-secondary"
                onclick="adicionarItem()"
            >
                Adicionar Produto
            </button>

            <hr>

            <h4>
                Total do Pedido:
                <strong>R$ <span id="total-pedido">0.00</span></strong>
            </h4>

            <br>

            <button class="btn btn-success">
                Salvar Pedido
            </button>

            <a href="{{ route('pedidos.index') }}"
               class="btn btn-default">
                Voltar
            </a>

        </form>

    </div>
</div>

@stop


@section('js')

<script>

function adicionarItem()
{
    let row = `
        <tr>

            <td>
                <input type="text"
                       name="produto[]"
                       class="form-control"
                       required>
            </td>

            <td>
                <input type="number"
                       step="0.01"
                       name="preco[]"
                       class="form-control preco"
                       required>
            </td>

            <td>
                <input type="number"
                       name="quantidade[]"
                       class="form-control quantidade"
                       required>
            </td>

            <td>
                <input type="text"
                       class="form-control total-item"
                       readonly>
            </td>

            <td>
                <button type="button"
                        class="btn btn-danger btn-sm"
                        onclick="removerLinha(this)">
                    Remover
                </button>
            </td>

        </tr>
    `;

    document
        .querySelector('#tabela-itens tbody')
        .insertAdjacentHTML('beforeend', row);
}

function removerLinha(btn)
{
    btn.closest('tr').remove();
    calcularTotalPedido();
}

document.addEventListener('input', function(e)
{
    if (e.target.classList.contains('preco') ||
        e.target.classList.contains('quantidade'))
    {
        calcularLinha(e.target.closest('tr'));
        calcularTotalPedido();
    }
});

function calcularLinha(row)
{
    let preco = row.querySelector('.preco').value || 0;
    let qtd   = row.querySelector('.quantidade').value || 0;

    let total = preco * qtd;

    row.querySelector('.total-item').value = total.toFixed(2);
}

function calcularTotalPedido()
{
    let total = 0;

    document
        .querySelectorAll('.total-item')
        .forEach(function(input)
        {
            total += parseFloat(input.value) || 0;
        });

    document
        .getElementById('total-pedido')
        .innerText = total.toFixed(2);
}

window.onload = function()
{
    calcularTotalPedido();
}

</script>

@stop