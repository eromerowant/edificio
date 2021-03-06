<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movimiento;
use Faker\Generator as Faker;

use App\Departamento;
use Carbon\Carbon;
use Illuminate\Support\Str;

$factory->define(Movimiento::class, function (Faker $faker) {
    return [
        'codigo_identificador' => Str::random(10),
        'monto' => rand(1000,15000),
        'tipo' => rand(1,2),
        'status' => rand(1,2),
        'fecha_de_confirmacion' => $faker->dateTimeBetween($startDate='-10 years', $endDate='-1 years', $timezone=null),
        'departamento_id' => Departamento::pluck('id')[$faker->numberBetween(1,Departamento::count()-1)],
        'created_at' => $faker->dateTimeBetween($startDate='-10 years', $endDate='-1 years', $timezone=null),
    ];
});
