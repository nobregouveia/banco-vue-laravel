<?php

namespace App\Repositories;

use App\Entities\Conta;
use App\Services\Auth\Senha;

class ContaRepository extends ConfigRepository
{
    public function __construct(Conta $model)
    {
        $this->model = $model;
        $this->senha = app(Senha::class);
    }

    public function create($data)
    {
        $data['password'] = $this->senha->hashPassword($data['password']);
        return parent::create($data);
    }

    public function buscaConta($numero_conta, $codigo_conta, $agencia)
    {
        return $this->model
                    ->where('numero_conta', $numero_conta)
                    ->where('codigo_conta',  $codigo_conta)
                    ->where('agencia', $agencia)
                    ->first();
    }
}
