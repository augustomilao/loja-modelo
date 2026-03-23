@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-lg-6 col-6">
        <div class="small-box bg-info">

            <div class="inner">
                <h3>10</h3>
                {{-- <h3>{{ $totalPedidos }}</h3> --}}
                <p>Total de pedidos</p>
            </div>

        </div>
    </div>

    <div class="col-lg-6 col-6">
        <div class="small-box bg-success">

            <div class="inner">
                {{-- <h3>R$ {{ number_format($totalVendido,2,',','.') }}</h3> --}}
                <h3>R$ 50.00</h3>
                <p>Total vendido</p>
            </div>

        </div>
    </div>

</div>

@stop