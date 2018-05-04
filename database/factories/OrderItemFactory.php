<?php

use Faker\Generator as Faker;

$factory->define(App\OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => $faker->randomElement(App\Order::all()->pluck('id')->toArray()),
        'menu_id' => $faker->randomElement(App\Menu::all()->pluck('id')->toArray()),
        'qty' => $faker->numberBetween($min = 1, $max = 5),
        'status' => 'completed'
    ];
});
