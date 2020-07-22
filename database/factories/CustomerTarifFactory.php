<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\CustomerTarifModel as Model;
use Illuminate\Support\Arr;


$factory->define(Model::class, function (Faker $faker) {
  $isactive = rand(0,100)>80 ? false : true;
    return [
        'customer_id' => $faker->biasedNumberBetween($min = 1, $max = 100, $function = 'sqrt'),
        'tarif_id' => $faker->biasedNumberBetween($min = 1, $max = 400, $function = 'sqrt'),
        'active' => $isactive
    ];
});
