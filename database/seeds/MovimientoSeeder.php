<?php

use Illuminate\Database\Seeder;

use App\Movimiento;

class MovimientoSeeder extends Seeder
{
    public function run()
    {
        factory(Movimiento::class, 80)->create();
    }
}
