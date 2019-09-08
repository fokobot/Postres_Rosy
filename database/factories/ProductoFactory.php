<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Producto::class, function (Faker $faker) {
    return [
      'nombre'                 => $faker->unique()->colorName,
      'valordetal'             => rand(5000, 100000),
      'valormayor'             => rand(5000, 100000),
      'minimopormayor'         => rand(5, 9),
    ];
});
