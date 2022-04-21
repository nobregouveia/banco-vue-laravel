<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Entities\Conta;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Services\Auth\Senha;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Conta::class, function (Faker $faker) {
    return [
        "nome" => $faker->name,
        "password" => Senha::hashPassword("1111"),
        "numero_conta" => $faker->unique()->numberBetween(100, 999),
        "codigo_conta" => $faker->unique()->numberBetween(1, 99),
        "saldo" => $faker->unique()->numberBetween(100, 2000),
        "agencia" => $faker->unique()->numberBetween(100, 999)
    ];
});
