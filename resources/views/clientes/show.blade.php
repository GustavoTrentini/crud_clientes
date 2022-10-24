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

    <div class="row">
        <div class="col-md-12">

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
                            <input class="form-control" type="text" disabled value="{{$cliente->codigo}}" placeholder="Código do cliente" required aria-label="Código">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome *</label>
                            <input class="form-control" type="text" disabled value="{{$cliente->nome}}" placeholder="Nome do cliente" required aria-label="Nome">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cpf_cnpj">CPF/CNPJ *</label>
                            <input class="form-control" type="text" onload="validaDocumento(this.value)" disabled value="{{$cliente->cpf_cnpj}}" placeholder="CPF/CNPJ do cliente" aria-label="Documento">
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefone">Telefone/Celular *</label>
                            <input class="form-control" disabled type="text" data-mask="(00) 00000-0000" onload="validaTelefone(this.value)" value="{{$cliente->fone}}" aria-label="Telefone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="codigo">Limíte de crédito (R$)</label>
                            <input class="form-control" disabled type="text" value="{{floatToCurrency($cliente->limiteCredito)}}" placeholder="Limite de crédito do cliente" aria-label="Limite de crédito">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="validade">Validade *</label>
                            <input class="form-control" disabled type="date" value="{{$cliente->validade->format('Y-m-d')}}" placeholder="dd/mm/yyyy" aria-label="data de validade">
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
                            <input class="form-control" type="text" data-mask="00000-000" disabled value="{{cepFormatter($cliente->cep)}}" placeholder="Cep do cliente" aria-label="Cep">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logradouro">Logradouro *</label>
                            <input class="form-control" disabled type="text" value="{{$cliente->logradouro}}" placeholder="Logradouro do cliente" aria-label="Logradouro">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bairro">Bairro *</label>
                            <input class="form-control" type="text" disabled value="{{$cliente->bairro}}" placeholder="Bairro do cliente" aria-label="Bairro">
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cidade">Cidade *</label>
                            <input class="form-control" type="text" disabled value="{{$cliente->cidade}}" placeholder="Cidade do cliente" aria-label="Cidade">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="uf">Estado (UF) *</label>
                            <input class="form-control" type="text" disabled value="{{$cliente->uf}}" placeholder="Estado do cliente" aria-label="Estado">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="numero">Número *</label>
                            <input class="form-control" type="text" disabled value="{{$cliente->numero}}" placeholder="Nº do cliente" aria-label="Número">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input class="form-control" disabled type="text" value="{{$cliente->complemento}}" placeholder="Complemento do cliente" aria-label="Complemento">
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection
