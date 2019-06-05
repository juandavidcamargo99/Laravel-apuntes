<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Profession;
use Faker\Generator as Faker;

$factory->define(Profession::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3, false)
    ];
});
