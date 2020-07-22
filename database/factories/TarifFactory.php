<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TarifModel as Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
  $tarif_price = $faker->biasedNumberBetween($min = 50, $max = 1000, $function = 'sqrt');
    return [
        'name' => 'Tarif'.$tarif_price,
        'company_id' => $faker->biasedNumberBetween($min = 1, $max = 20, $function = 'sqrt'),
    ];
});
