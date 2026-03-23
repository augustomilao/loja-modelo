@extends('adminlte::page')

@section('title', 'Editar Transportadora')

@section('content_header')
    <h1>Editar Transportadora</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('transportadoras.update', $transportadora->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6">
                    <label>Nome</label>
                    <input type="text"
                           name="nome"
                           class="form-control"
                           value="{{ $transportadora->nome }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label>CNPJ</label>
                    <input type="text"
                           name="cnpj"
                           class="form-control"
                           value="{{ $transportadora->cnpj }}"
                           required>
                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-3">
                    <label>CEP</label>
                    <input type="text"
                           id="cep"
                           name="cep"
                           class="form-control"
                           value="{{ $transportadora->cep }}"
                           required>
                </div>

                <div class="col-md-3">
                    <label>Estado</label>
                    <input type="text"
                           id="estado"
                           name="estado"
                           class="form-control"
                           value="{{ $transportadora->estado }}"
                           required>
                </div>

                <div class="col-md-3">
                    <label>Cidade</label>
                    <input type="text"
                           id="cidade"
                           name="cidade"
                           class="form-control"
                           value="{{ $transportadora->cidade }}"
                           required>
                </div>

                <div class="col-md-3">
                    <label>Bairro</label>
                    <input type="text"
                           id="bairro"
                           name="bairro"
                           class="form-control"
                           value="{{ $transportadora->bairro }}"
                           required>
                </div>

            </div>

            <br>

            <div class="row">

                <div class="col-md-6">
                    <label>Rua</label>
                    <input type="text"
                           id="rua"
                           name="rua"
                           class="form-control"
                           value="{{ $transportadora->rua }}"
                           required>
                </div>

                <div class="col-md-2">
                    <label>Número</label>
                    <input type="text"
                           name="numero"
                           class="form-control"
                           value="{{ $transportadora->numero }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label>Complemento</label>
                    <input type="text"
                           name="complemento"
                           class="form-control"
                           value="{{ $transportadora->complemento }}">
                </div>

            </div>

            <br>

            <button class="btn btn-success">
                Atualizar
            </button>

            <a href="{{ route('transportadoras.index') }}"
               class="btn btn-secondary">
                Voltar
            </a>

        </form>

    </div>
</div>

@stop


@section('js')

<script>

document.getElementById('cep').addEventListener('blur', function() {

    let cep = this.value.replace(/\D/g, '');

    if (cep.length !== 8) return;

    fetch('https://viacep.com.br/ws/' + cep + '/json/')
        .then(response => response.json())
        .then(data => {

            if (data.erro) return;

            document.getElementById('estado').value = data.uf;
            document.getElementById('cidade').value = data.localidade;
            document.getElementById('bairro').value = data.bairro;
            document.getElementById('rua').value = data.logradouro;
        });

});

</script>

@stop