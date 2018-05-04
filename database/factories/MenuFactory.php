<?php

use Faker\Generator as Faker;

$factory->define(App\Menu::class, function (Faker $faker) {
    return [
        'store_id' => $faker->randomElement(App\Store::all()->pluck('id')->toArray()),
        'name' => 'Menu ' . $faker->unique()->randomDigit,
        'type' => $faker->randomElement(['food', 'beverage']),
        'price' => $faker->numberBetween($min = 5, $max = 20) * 1000,
        'status' => $faker->boolean
    ];
});
