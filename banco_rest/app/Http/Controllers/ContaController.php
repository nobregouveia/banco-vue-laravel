<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContaService;

class ContaController extends Controller
{

    public function __construct (ContaService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request)
    {
        $data = [
            "nome" => $request->nome,
            "password" => $request->password,
            "numero_conta" => $request->numero_conta,
            "codigo_conta" => $request->codigo_conta,
            "agencia" => $request->agencia,
        ];

        $result = $this->service->create($data);
        return response()->json($result);
    }

    public function transacao(Request $request)
    {
        $result = $this->service->transacao($request);
        return response()->json($result);
    }

    public function extrato($numero_conta, $codigo_conta, $agencia)
    {
        $result = $this->service->extrato($numero_conta, $codigo_conta, $agencia);
        return response()->json($result);
    }

    public function saldo($numero_conta, $codigo_conta, $agencia)
    {
        $result = $this->service->saldo($numero_conta, $codigo_conta, $agencia);
        return response()->json($result);
    }
}
