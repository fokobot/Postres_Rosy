<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Cliente::class, function (Faker $faker) {
    return [
      'tipo_de_documento_id'   => rand(1,2),
      'documento'              => $faker->unique()->ssn,
      'nombre'                 => $faker->firstname,
      'apellidos'              => $faker->lastname,
      'direccion'              => $faker->address,
      'ciudad'                 => $faker->city,
      'telefono'               => $faker->phonenumber,
      'celular'                => $faker->phonenumber,
    ];
});
