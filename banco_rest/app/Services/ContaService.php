<?php

namespace App\Services;

use App\Exceptions\ErroMensagem;
use App\Repositories\ContaRepository;
use App\Repositories\TransacaoRepository;
use App\Services\Transacao\TransacaoRegra;

class ContaService extends ConfigService
{
    protected $transacaoRepository;

    public function __construct(
        ContaRepository $contaRepository,
        TransacaoRepository $transacaoRepository
    ) {
        $this->NotFoundMessage = "Conta não encontrada!";
        $this->repository = $contaRepository;
        $this->transacaoRepository = $transacaoRepository;
    }

    public function transacao($transacao)
    {
        $conta = $this->repository->buscaConta(
            $transacao->numero_conta,
            $transacao->codigo_conta,
            $transacao->agencia
        );

        if (!$conta) {
            throw new ErroMensagem('Dados inválidos.', 400);
        }

        $transacaoRegra = new TransacaoRegra($transacao);
        $transacao = $transacaoRegra->processo($conta);

        return $transacao;
    }

    public function extrato($numero_conta, $codigo_conta, $agencia)
    {
        $conta = $this->repository->buscaConta($numero_conta, $codigo_conta, $agencia);

        if (!$conta) {
            throw new ErroMensagem('Dados inválidos.', 400);
        }

        $transacoes = $this->transacaoRepository->listarPor($conta->id);

        return $transacoes;
    }

    public function saldo($numero_conta, $codigo_conta, $agencia)
    {
        $conta = $this->repository->buscaConta($numero_conta, $codigo_conta, $agencia);

        if (!$conta) {
            throw new ErroMensagem('Dados inválidos.', 400);
        }

        $saldo = $conta->first()->saldo;
        return [ "saldo" => $saldo ];
    }
}
