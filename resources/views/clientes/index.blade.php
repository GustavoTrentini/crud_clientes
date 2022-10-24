@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 p-4">
            <h2 class="title text-secondary text-center">Cadastro de clientes</h2>
        </div>
    </div>
    @if(session()->has('message'))
    <div class="row my-2">
        <div class="col-md-12">
            <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    <div class="row my-2">
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{route('clientes.create')}}" class="btn btn-success">Novo cliente</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 my-2">
            <table class="table table-light table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>DOCUMENTO</th>
                        <th>VALIDADE</th>
                        <th>LIMITE DE CRÉDITO</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->id}}</td>
                        <td>{{$cliente->nome}}</td>
                        <td>{{$cliente->cpf_cnpj}}</td>
                        <td>{{$cliente->validade->format('d/m/Y')}}</td>
                        <td>R$ {{floatToCurrency($cliente->limiteCredito)}}</td>
                        <td class="d-flex justify-content-around">
                            <a href="{{route('clientes.show', ['id' => $cliente->id])}}" class="btn btn-sm btn-primary ml-1">Ver</a>
                            <a href="{{route('clientes.edit', ['id' => $cliente->id])}}" class="btn btn-sm btn-warning ml-1">Editar</a>

                            <form action="{{route('clientes.delete', ['id' => $cliente->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger ml-1">Deletar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
