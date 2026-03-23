@extends('adminlte::page')

@section('title', 'Downloads')

@section('content_header')
    <h1>Downloads de Pedidos</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Arquivo</th>
                    <th>Filtro</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>

                @forelse($exports as $export)

                    <tr>

                        <td>{{ $export->id }}</td>

                        <td>{{ $export->file_name }}</td>

                        <td>
                            {{ $export->nome_cliente ?? 'Todos' }}
                        </td>

                        <td>

                            @if($export->status == 'processing')
                                <span class="badge badge-warning">
                                    Processando
                                </span>
                            @else
                                <span class="badge badge-success">
                                    Pronto
                                </span>
                            @endif

                        </td>

                        <td>

                            @if($export->status == 'completed')

                                <a href="{{ route('pedidos.download', $export->id) }}"
                                   class="btn btn-success btn-sm">
                                    Baixar
                                </a>

                            @else

                                <span class="text-muted">
                                    Aguarde
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            Nenhuma exportação encontrada
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop