<?php

namespace App\Services\Transacao;

use App\Exceptions\ErroMensagem;
use App\Entities\Transacao;
use App\Enums\TransacaoEnum;
use App\Services\Auth\Senha;

class TransacaoRegra implements TransacaoInterface
{
    protected $transacao;

    public function __construct($transacao)
    {
        $this->transacao = $transacao;
        $this->senha = app(Senha::class);
    }

    public function processo($conta): Transacao
    {
        $operacoesParaConta = [
            TransacaoEnum::SAQUE => 'saque',
            TransacaoEnum::DEPOSITO => 'deposito',
        ];

        return $this->{$operacoesParaConta[$this->transacao->tipo]}($conta);
    }

    public function saque($conta)
    {
        if (!$this->senha->verifica($this->transacao->password, $conta->password)) {
            throw new ErroMensagem('Não foi possível realizar a operação, senha incorreta.', 400);
        }

        if (($conta->saldo < $this->transacao->valor) || !$this->transacao->valor) {
            throw new ErroMensagem('Saldo insuficiente.', 400);
        }

        $conta->saldo -= abs($this->transacao->valor);
        $nova_transacao = new Transacao();
        $nova_transacao->valor = abs($this->transacao->valor);
        $nova_transacao->tipo = TransacaoEnum::SAQUE;
        $nova_transacao->id_conta = $conta->id;

        $nova_transacao->save();
        $conta->save();

        return $nova_transacao;
    }

    public function deposito($conta)
    {
        $conta->saldo += $this->transacao->valor;
        $nova_transacao = new Transacao();
        $nova_transacao->valor = $this->transacao->valor;
        $nova_transacao->tipo = TransacaoEnum::DEPOSITO;
        $nova_transacao->id_conta = $conta->id;

        $nova_transacao->save();
        $conta->save();

        return $nova_transacao;
    }
}
