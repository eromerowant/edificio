<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Departamento;
use Faker\Generator as Faker;

$factory->define(Departamento::class, function (Faker $faker) {
    return [
        'numero' => rand(1,1000),
    ];
});
