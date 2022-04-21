<?php

use Illuminate\Database\Seeder;
use App\Entities\Conta;
use App\Services\Auth\Senha;

class ContaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $contas = [
            [
                "nome" => "Andre Gouveia",
                "password" => "1234",
                "numero_conta" => "321",
                "codigo_conta" => "08",
                "saldo" => 850,
                "agencia" => "793"
            ]
        ];

        foreach ($contas as $conta) {
            Conta::create($conta);
        }
    }
}
