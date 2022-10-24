<?php

namespace App\Modules;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Clientes;

class ApiClientes extends Controller
{

    protected $roles = [
        "codigo" => "required|max:15",
        "nome" => "required|max:150",
        "cpf_cnpj" => "required|max:20|unique:clientes,cpf_cnpj",
        "fone" => "required|max:15",
        "limiteCredito" => "",
        "validade" => "required|after:yesterday",
        "cep" => "required|max:9",
        "logradouro" => "required|max:100",
        "bairro" => "required|max:50",
        "cidade" => "required|max:60",
        "uf" => "required|max:2",
        "complemento" => "max:150",
        "numero" => "required"
    ];

    public function list()
    {
        return response()->json(Clientes::all(), 200);
    }

    public function show($id)
    {

        $cliente = Clientes::find($id);

        if ($cliente) {
            return response()->json($cliente, 200);
        } else {
            return response()->json([
                "code" => 404,
                "message" => "Cliente $id não encontrado"
            ], 404);
        }
    }

    public function store(Request $request, Clientes $clientes)
    {
        $data = $request->all();
        $data['limiteCredito'] = currencyToFloat($data['limiteCredito']);
        $data['cpf_cnpj'] = sanitizeSringData($data['cpf_cnpj']);
        $data['fone'] = sanitizeSringData($data['fone']);
        $data['cep'] = sanitizeSringData($data['cep']);

        $validator = Validator::make($data, $this->roles);

        if ($validator->fails()) {
            return response()->json([
                "code" => 500,
                "message" => "Não foi possível cadastrar o cliente via API ",
                "errors" => $validator->errors()
            ], 500);
        } else {

            $cliente = $clientes->create($data);

            if ($cliente) {
                return response()->json($cliente, 200);
            } else {
                return response()->json([
                    "code" => 500,
                    "message" => "Não foi possível cadastrar o cliente via API "
                ], 500);
            }
        }
    }

    public function update(Request $request, Clientes $clientes, $id)
    {

        $rules = (object)$this->roles;
        $rules->cpf_cnpj = [Rule::unique('clientes', 'cpf_cnpj')->ignore($id), "required", "max:20"];

        $data = $request->all();
        $data['limiteCredito'] = currencyToFloat($data['limiteCredito']);
        $data['cpf_cnpj'] = sanitizeSringData($data['cpf_cnpj']);
        $data['fone'] = sanitizeSringData($data['fone']);
        $data['cep'] = sanitizeSringData($data['cep']);

        $validator = Validator::make($data, (array)$rules);

        if ($validator->fails()) {
            return response()->json([
                "code" => 500,
                "message" => "Não foi possível cadastrar o cliente via API ",
                "errors" => $validator->errors()
            ], 500);
        } else {
            $cliente = $clientes->find($id);
            $cliente->update($data);

            if ($cliente->wasChanged()) {
                return response()->json($cliente, 200);
            } else {
                return response()->json([
                    "code" => 500,
                    "message" => "Não foi possível cadastrar o cliente via API "
                ], 500);
            }
        }
    }

    public function delete(Clientes $clientes, $id)
    {

        if ($clientes->destroy($id)) {
            return response()->json([
                "code" => 200,
                "message" => "Cliente $id deletado com sucesso"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "Não foi possível deletar o cliente via API "
            ], 500);
        }
    }
}
