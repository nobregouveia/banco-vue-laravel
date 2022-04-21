<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $table = 'contas';

    protected $fillable = [
        'nomw',
        'saldo',
        'numero_conta',
        'codigo_conta',
        'agencia',
        'password'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }
}
