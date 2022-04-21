<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = [
        'valor',
        'tipo',
        'id_conta',
        'created_at'
    ];

    protected $hidden = ['updated_at'];

    public function conta() {
        return $this->belongsTo(Conta::class);
    }
}
