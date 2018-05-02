<?php

use Faker\Generator as Faker;

$factory->define(App\Menu::class, function (Faker $faker) {
    return [
        'store_id' => $faker->randomElement(App\Store::all()->pluck('id')->toArray()),
        'name' => 'Some food',
        'price' => 10000,
        'status' => $faker->boolean
    ];
});
