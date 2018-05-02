<?php

use Faker\Generator as Faker;

$factory->define(App\Store::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'location' => $faker->address,
        'status' => $faker->boolean
    ];
});
