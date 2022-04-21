<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\Conta;

class ContaFakeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Conta::class, 10)->create();
    }
}
