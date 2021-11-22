<?php

use Illuminate\Database\Seeder;

use App\Departamento;

class DepartamentoSeeder extends Seeder
{
    public function run()
    {
        factory(Departamento::class, 20)->create();
    }
}
