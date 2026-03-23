@extends('adminlte::page')

@section('title', 'Detalhes da Transportadora')

@section('content_header')
    <h1>Transportadora #{{ $transportadora->id }}</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">
                <label><strong>Nome</strong></label>
                <p>{{ $transportadora->nome }}</p>
            </div>

            <div class="col-md-6">
                <label><strong>CNPJ</strong></label>
                <p>{{ $transportadora->cnpj }}</p>
            </div>

        </div>

        <hr>

        <h4>Endereço</h4>

        <div class="row">

            <div class="col-md-2">
                <label><strong>CEP</strong></label>
                <p>{{ $transportadora->cep }}</p>
            </div>

            <div class="col-md-2">
                <label><strong>Estado</strong></label>
                <p>{{ $transportadora->estado }}</p>
            </div>

            <div class="col-md-4">
                <label><strong>Cidade</strong></label>
                <p>{{ $transportadora->cidade }}</p>
            </div>

            <div class="col-md-4">
                <label><strong>Bairro</strong></label>
                <p>{{ $transportadora->bairro }}</p>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <label><strong>Rua</strong></label>
                <p>{{ $transportadora->rua }}</p>
            </div>

            <div class="col-md-2">
                <label><strong>Número</strong></label>
                <p>{{ $transportadora->numero }}</p>
            </div>

            <div class="col-md-4">
                <label><strong>Complemento</strong></label>
                <p>{{ $transportadora->complemento ?? '-' }}</p>
            </div>

        </div>

        <hr>

        <a href="{{ route('transportadoras.index') }}"
           class="btn btn-secondary">
            Voltar
        </a>

        <a href="{{ route('transportadoras.edit', $transportadora->id) }}"
           class="btn btn-warning">
            Editar
        </a>

    </div>

</div>

@stop