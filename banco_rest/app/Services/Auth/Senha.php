<?php

namespace App\Models\Services\Auth;

class Senha
{
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifica($password, $conta_password)
    {
        return password_verify($password, $conta_password);
    }
}
