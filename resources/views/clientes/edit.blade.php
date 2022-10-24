@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 p-4">
            <h2 class="title">Cliente: {{$cliente->nome}}</h2>
            <h6 class="title">Código: {{$cliente->id}}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 d-flex">
            <a href="{{route('clientes.index')}}" class="btn btn-warning btn-sm">Voltar</a>
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
            <form action="{{route('clientes.update', ['id' => $cliente->id])}}" method="POST">
                @method('PUT')
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
                            <input class="form-control" value="{{$cliente->codigo}}" type="text" id="codigo" name="codigo" maxlength="15" placeholder="Código do cliente" required aria-label="Código">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome *</label>
                            <input class="form-control" type="text" value="{{$cliente->nome}}" id="nome" name="nome" placeholder="Nome do cliente" required aria-label="Nome">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cpf_cnpj">CPF/CNPJ *</label>
                            <input class="form-control" type="text" value="{{$cliente->cpf_cnpj}}" onkeydown="validaDocumento(this.value)" required id="cpf_cnpj" name="cpf_cnpj" placeholder="CPF/CNPJ do cliente" aria-label="Documento">
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefone">Telefone/Celular *</label>
                            <input class="form-control" type="text" value="{{$cliente->fone}}" onkeydown="validaTelefone(this.value)" id="fone" required name="fone" placeholder="(00) 0000-0000" aria-label="Telefone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="codigo">Limíte de crédito (R$)</label>
                            <input class="form-control" value="{{number_format($cliente->limiteCredito, 2, '.', '')}}" data-mask-reverse="true" type="text" id="limiteCredito" name="limiteCredito" data-mask="#.##0,00" placeholder="Limite de crédito do cliente" aria-label="Limite de crédito">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="validade">Validade *</label>
                            <input class="form-control" type="date" value="{{$cliente->validade->format('Y-m-d')}}" id="validade" required name="validade" min="{{date('Y-m-d')}}" placeholder="dd/mm/yyyy" aria-label="data de validade">
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
                            <input class="form-control" type="text" id="cep" value="{{cepFormatter($cliente->cep)}}" data-mask="00000-000" name="cep" required onchange="consultaCep(this.value)" placeholder="Cep do cliente" aria-label="Cep">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logradouro">Logradouro *</label>
                            <input class="form-control" type="text" id="logradouro" value="{{$cliente->logradouro}}" required name="logradouro" placeholder="Logradouro do cliente" aria-label="Logradouro">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bairro">Bairro *</label>
                            <input class="form-control" type="text" id="bairro" value="{{$cliente->bairro}}" required name="bairro" placeholder="Bairro do cliente" aria-label="Bairro">
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cidade">Cidade *</label>
                            <input class="form-control" type="text" required value="{{$cliente->cidade}}" id="cidade" name="cidade" placeholder="Cidade do cliente" aria-label="Cidade">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="uf">Estado (UF) *</label>
                            <input class="form-control" type="text" required value="{{$cliente->uf}}" id="uf" name="uf" maxlength="2" placeholder="Estado do cliente" aria-label="Estado">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="numero">Número *</label>
                            <input class="form-control" type="text" required id="numero" value="{{$cliente->numero}}" name="numero" placeholder="Nº do cliente" aria-label="Número">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input class="form-control" type="text" id="complemento" value="{{$cliente->complemento}}" name="complemento" placeholder="Complemento do cliente" aria-label="Complemento">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12 d-flex justify-content-center">
                        <button type="submit" id="btnSubmit" href="#" class="btn btn-success btn-lg">Salvar alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    validaDocumento("{{$cliente->cpf_cnpj}}", 1);
    validaTelefone("{{$cliente->fone}}", 1);

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

    function validaDocumento(documento, withMask = 0) {
        if (withMask == 0) {
            if (documento.length >= 14) {
                $('#cpf_cnpj').mask('00.000.000/0000-00', {
                    reverse: true
                });
            } else {
                $('#cpf_cnpj').mask('000.000.000-00', {
                    reverse: true
                });
            }
        } else {
            if (documento.length >= 12) {
                $('#cpf_cnpj').mask('00.000.000/0000-00', {
                    reverse: true
                });
            } else {
                $('#cpf_cnpj').mask('000.000.000-00', {
                    reverse: true
                });
            }
        }
    }

    function validaTelefone(telefone, withMask = 0) {
        if (withMask == 0) {
            if (telefone.length >= 14) {
                $('#fone').mask('(00) 00000-0000');
            } else {
                $('#fone').mask('(00) 0000-0000');
            }
        } else {
            if (telefone.length >= 11) {
                $('#fone').mask('(00) 00000-0000');
            } else {
                $('#fone').mask('(00) 0000-0000');
            }
        }
    }
</script>
@endpush
@endsection
