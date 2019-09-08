<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Gasto::class, function (Faker $faker) {
    return [
      'descripcion'        => $faker->sentence,
      'valor'              => rand(5000, 100000),
      'estado_id'          => rand(1,2),
      'fecha'              => $faker->datetime,
    ];
});
