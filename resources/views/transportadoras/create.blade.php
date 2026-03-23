@extends('adminlte::page')

@section('title', 'Nova Transportadora')

@section('content_header')
    <h1>Nova Transportadora</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('transportadoras.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-6">
                    <label>Nome</label>
                    <input type="text"
                           name="nome"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-6">
                    <label>CNPJ</label>
                    <input type="text"
                           name="cnpj"
                           class="form-control"
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
                           required>
                </div>

                <div class="col-md-3">
                    <label>Estado</label>
                    <input type="text"
                           id="estado"
                           name="estado"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-3">
                    <label>Cidade</label>
                    <input type="text"
                           id="cidade"
                           name="cidade"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-3">
                    <label>Bairro</label>
                    <input type="text"
                           id="bairro"
                           name="bairro"
                           class="form-control"
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
                           required>
                </div>

                <div class="col-md-2">
                    <label>Número</label>
                    <input type="text"
                           name="numero"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-4">
                    <label>Complemento</label>
                    <input type="text"
                           name="complemento"
                           class="form-control">
                </div>

            </div>

            <br>

            <button class="btn btn-success">
                Salvar
            </button>

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