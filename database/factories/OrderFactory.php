<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(App\User::all()->pluck('id')->toArray()),
        'status' => $faker->boolean
    ];
});
