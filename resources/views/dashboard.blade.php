@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-md-6">

        <div class="small-box bg-info">

            <div class="inner">
                <h3>{{ $totalPedidos }}</h3>
                <p>Total de Pedidos</p>
            </div>

            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>

            <a href="{{ route('pedidos.index') }}"
               class="small-box-footer">
                Ver pedidos
            </a>

        </div>

    </div>

    <div class="col-md-6">

        <div class="small-box bg-success">

            <div class="inner">
                <h3>
                    R$ {{ number_format($totalVendido, 2, ',', '.') }}
                </h3>

                <p>Total Vendido</p>
            </div>

            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>

        </div>

    </div>

</div>

@stop