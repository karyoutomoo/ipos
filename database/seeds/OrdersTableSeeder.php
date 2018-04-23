<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Food;
use App\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      Order::truncate();

      $faker = \Faker\Factory::create();

      $validator = function($digit){
        return User::find($digit); 
      };

      $empValidator = function($digit){
        return User::find($digit); 
      };

      $foodValidator = function($digit){
        return Food::find($digit);
      };

      for ($i=0; $i < 20; $i++) { 
        # code...
        Order::create([
          'user_id' => $faker->valid($validator)->randomDigit,
          'employee_id' => $faker->valid($empValidator)->randomDigit,
          'food_id' => $faker->valid($foodValidator)->randomDigit,
          'food_status' => $faker->numberBetween($min = 1, $max = 5),
        ]);
      }
    }
}
