@extends('adminlte::page')

@section('title', 'Documentação')

@section('content_header')
    <h1>Documentação da Aplicação</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <h4>Dashboard</h4>

        <ul>
            <li>Total de pedidos</li>
            <li>Total vendido (R$)</li>
        </ul>

        <hr>

        <h4>Pedidos</h4>

        <ul>
            <li>CRUD completo</li>
            <li>Vários produtos por pedido</li>
            <li>Cálculo automático do total</li>
            <li>Filtro por nome do cliente</li>
            <li>Exportação assíncrona de pedidos</li>
        </ul>

        <hr>

        <h4>Transportadoras</h4>

        <ul>
            <li>CRUD completo</li>
            <li>Consulta automática de CEP via ViaCEP</li>
            <li>Preenchimento automático de endereço</li>
        </ul>

        <hr>

        <h4>API de Pedidos</h4>

        <div class="table-responsive">
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Método</th>
                        <th>Endpoint</th>
                        <th>Descrição</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>GET</td>
                        <td>/api/pedidos</td>
                        <td>Lista todos os pedidos</td>
                    </tr>

                    <tr>
                        <td>GET</td>
                        <td>/api/pedidos/{id}</td>
                        <td>Consulta pedido por ID</td>
                    </tr>

                    <tr>
                        <td>POST</td>
                        <td>/api/pedidos</td>
                        <td>Criar novo pedido</td>
                    </tr>

                </tbody>

            </table>
        </div>

        <hr>

        <h4>MCP</h4>

        <div class="table-responsive">
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Método</th>
                        <th>Endpoint</th>
                        <th>Descrição</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>GET</td>
                        <td>/api/mcp/pedidos</td>
                        <td>Indicadores e últimos pedidos</td>
                    </tr>

                    <tr>
                        <td>GET</td>
                        <td>/api/mcp/pedidos/{id}</td>
                        <td>Consulta pedido detalhado</td>
                    </tr>

                    <tr>
                        <td>GET</td>
                        <td>/api/mcp/search?nome_cliente=</td>
                        <td>Busca pedidos por nome</td>
                    </tr>

                </tbody>

            </table>
        </div>

    </div>

</div>

@stop