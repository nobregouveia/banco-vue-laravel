<?php

namespace App\Services;

use App\Exceptions\ErroMensagem;

abstract class ConfigService
{
    protected $repository;
    protected $NotFoundMessage;

    public function all()
    {
        return $this->repository->all(['*']);
    }

    public function find($id)
    {
        $model = $this->repository->find($id);
        if(!$model) {
            throw new ErroMensagem($this->NotFoundMessage, 404);
        }

        return $model;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

}
