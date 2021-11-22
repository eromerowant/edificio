<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(MovimientoSeeder::class);
    }
}
