@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 p-4">
            <h2 class="title text-center">Cadastro de clientes</h2>
        </div>
    </div>

    @if ($errors->any())
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <form action="{{route('clientes.store')}}" method="POST">
                @csrf
                <div class="row my-4">
                    <div class="col-md-12">
                        <h4 class="title text-secondary">Dados de pessoais</h4>
                        <hr>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="codigo">Código *</label>
                            <input class="form-control" type="text" id="codigo" name="codigo" maxlength="15" placeholder="Código do cliente" required aria-label="Código">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome *</label>
                            <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome do cliente" required aria-label="Nome">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cpf_cnpj">CPF/CNPJ *</label>
                            <input class="form-control" type="text" onkeydown="validaDocumento(this.value)" required id="cpf_cnpj" name="cpf_cnpj" placeholder="CPF/CNPJ do cliente" aria-label="Documento">
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefone">Telefone/Celular *</label>
                            <input class="form-control" type="text" onkeydown="validaTelefone(this.value)" id="fone" required name="fone" placeholder="(00) 0000-0000" aria-label="Telefone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="codigo">Limíte de crédito (R$)</label>
                            <input class="form-control" type="text" id="limiteCredito" name="limiteCredito" placeholder="Limite de crédito do cliente" aria-label="Limite de crédito">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="validade">Validade *</label>
                            <input class="form-control" type="date" id="validade" required name="validade" min="{{date('Y-m-d')}}" placeholder="dd/mm/yyyy" aria-label="data de validade">
                        </div>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-md-12">
                        <h4 class="title text-secondary">Dados de endereço</h4>
                        <hr>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cep">CEP *</label>
                            <input class="form-control" type="text" id="cep" name="cep" required onchange="consultaCep(this.value)" placeholder="Cep do cliente" aria-label="Cep">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logradouro">Logradouro *</label>
                            <input class="form-control" type="text" id="logradouro" required name="logradouro" placeholder="Logradouro do cliente" aria-label="Logradouro">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bairro">Bairro *</label>
                            <input class="form-control" type="text" id="bairro" required name="bairro" placeholder="Bairro do cliente" aria-label="Bairro">
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cidade">Cidade *</label>
                            <input class="form-control" type="text" required id="cidade" name="cidade" placeholder="Cidade do cliente" aria-label="Cidade">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="uf">Estado (UF) *</label>
                            <input class="form-control" type="text" required id="uf" name="uf" maxlength="2" placeholder="Estado do cliente" aria-label="Estado">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="numero">Número *</label>
                            <input class="form-control" type="text" required id="numero" name="numero" placeholder="Nº do cliente" aria-label="Número">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input class="form-control" type="text" id="complemento" name="complemento" placeholder="Complemento do cliente" aria-label="Complemento">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12 d-flex justify-content-center">
                        <button type="submit" id="btnSubmit" class="btn btn-success btn-lg">Salvar alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#limiteCredito').mask("#.##0,00", {
        reverse: true
    });
    $('#fone').mask('(00) 0000-0000');
    $('#cep').mask('00000-000');

    function consultaCep(cep) {
        cep = cep.replace('-', '');

        fetch(`https://viacep.com.br/ws/${cep}/json`)
            .then((response) => {
                response.json().then((data) => {
                    document.querySelector("#logradouro").value = data.logradouro;
                    document.querySelector("#bairro").value = data.bairro;
                    document.querySelector("#cidade").value = data.localidade;
                    document.querySelector("#uf").value = data.uf;
                    document.querySelector("#complemento").value = data.complemento;
                    document.querySelector("#btnSubmit").classList.remove('disabled');
                });
            }).catch((error) => {
                Swal.fire('Oops!', "Cep não encontrado na base de dados da VIACEP", 'error');
                document.querySelector("#btnSubmit").classList.add('disabled');

            });
    }

    function validaDocumento(documento) {
        if (documento.length >= 14) {
            $('#cpf_cnpj').mask('00.000.000/0000-00', {
                reverse: true
            });
        } else {
            $('#cpf_cnpj').mask('000.000.000-00', {
                reverse: true
            });
        }
    }

    function validaTelefone(telefone) {
        if (telefone.length >= 14) {
            $('#fone').mask('(00) 00000-0000');
        } else {
            $('#fone').mask('(00) 0000-0000');
        }
    }
</script>
@endpush
@endsection
