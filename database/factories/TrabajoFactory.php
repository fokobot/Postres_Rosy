<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Trabajo::class, function (Faker $faker) {
    return [
      'nombre'            => $faker->unique()->domainName,
      'costo'             => rand(5000, 100000),
    ];
});
