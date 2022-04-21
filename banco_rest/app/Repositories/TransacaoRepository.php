<?php

namespace App\Repositories;
use App\Entities\Transacao;

class TransacaoRepository extends ConfigRepository
{
    public function __construct(Transacao $model)
    {
        $this->model = $model;
    }

    public function listarPor($contaId)
    {
        return $this->model->where('id_conta', $contaId)->get();
    }
}
