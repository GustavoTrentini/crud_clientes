<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idUsuario')->nullable();
            $table->dateTime('dataHoraCadastro')->useCurrent();
            $table->string('codigo', 15)->nullable();
            $table->string('nome', 150);
            $table->string('cpf_cnpj', 20);
            $table->integer('cep');
            $table->string('logradouro', 100);
            $table->string('numero', 20);
            $table->string('bairro', 50);
            $table->string('cidade', 60);
            $table->string('uf', 2);
            $table->string('complemento', 150)->nullable();
            $table->string('fone', 15);
            $table->float('limiteCredito');
            $table->date('validade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
