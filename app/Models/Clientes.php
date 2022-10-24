<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUsuario',
        'dataHoraCadastro',
        'codigo',
        'nome',
        'cpf_cnpj',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'complemento',
        'fone',
        'limiteCredito',
        'validade'
    ];

    protected $dates = [
        'dataHoraCadastro',
        'validade',
        'created_at',
        'updated_at',
    ];
}
