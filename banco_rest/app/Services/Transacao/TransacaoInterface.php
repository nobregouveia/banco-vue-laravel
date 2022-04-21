<?php

namespace App\Services\Transacao;

use App\Entities\Transacao;

interface  TransacaoInterface
{
    public function processo($conta): Transacao;
}
